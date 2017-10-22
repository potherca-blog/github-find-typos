<?php

namespace Potherca\GiFiTy;

use Dotenv\Dotenv;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$projectPath = dirname(__DIR__);

require $projectPath.'/vendor/autoload.php';

// =============================================================================
/*/ Grab things from Disk, DB, Request, Environment, etc. /*/
// -----------------------------------------------------------------------------
/* Load `.env` */
if (is_readable($projectPath . '/.env')) {
  $dotenv = new Dotenv($projectPath, '.env');
  $dotenv->load();
  unset($dotenv);
}

// -----------------------------------------------------------------------------
/* Read `composer.json` content */
$project = json_decode(file_get_contents($projectPath.'/composer.json'), true);
// =============================================================================


// =============================================================================
/*/ Project specfic configuration /*/
// -----------------------------------------------------------------------------
require $projectPath.'/src/GiFiTy/function.fetch_results.php';

$callback = '\\Potherca\\GiFiTy\\fetch_results';

$parameters = require $projectPath.'/src/GiFiTy/config.command.php';

$templateLanguage = 'mustache';
$resultTemplatePath = $projectPath.'/src/GiFiTy/template/result.'.$templateLanguage;

$resultTemplate = file_get_contents($resultTemplatePath);

$userContext = [
  'description' => 'Fill in your faborite typing mistake (typo) in the field below and press the buttin',
  'project' => ['version' => exec('git tag | tail -n1')],
  'submit_icon' => 'search',
  'submit_name' => 'Search',
  'title' => 'Find Typos on Github',
];

$valueDecoraters = [
  'search-term' => function ($searchTerm) {
    /* Only grab the first word */
    $words = explode(' ', trim($searchTerm));
    return array_shift($words);
  },
];
// =============================================================================


// =============================================================================
// Call "Potherca\WebApplication" logic
// -----------------------------------------------------------------------------
$userContext = \Potherca\WebApplication\Generic\create_potherca_context($userContext);

/* Load GET parameters  */
$arguments = \Potherca\WebApplication\Generic\load_values(
  $parameters,      // array - configures which arguments, options and flags are available
  $valueDecoraters  // array - values or callbacks that are applied to the user input values
);

/* Create the result */
$results = $callback($arguments);

/* Context the UI content is based on */

$context =\Potherca\WebApplication\Generic\create_context(
  $arguments,   // array - Created by "potherca/webapplication"
  $results,     // array - Created by "callback"
  $project,     // array - from `composer.json` content
  $userContext  // array - override values in the context that is fead to the templates
);

/* Create UI content */
$content = \Potherca\WebApplication\Generic\create_content(
  $templateLanguage,  // language the result template is written in. Can be plain PHP or Mustache
  $resultTemplate,    // string that consists of the template the result array is fed to
  $context            // Created by "potherca/webapplication"
);
// =============================================================================


echo $content;
exit;

/*EOF*/
