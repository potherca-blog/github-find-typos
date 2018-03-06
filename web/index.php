<?php

namespace Potherca\GiFiTy;

define('PROJECT_ROOT', dirname(__DIR__));

// =============================================================================
// Project specfic configuration
// -----------------------------------------------------------------------------
require PROJECT_ROOT.'/src/function.fetch_results.php';

$callback = '\\Potherca\\GiFiTy\\fetch_results';

$parameters = require PROJECT_ROOT.'/src/config.command.php';

$templateLanguage = 'mustache';
$resultTemplatePath = PROJECT_ROOT.'/src/template/result.'.$templateLanguage;

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

require dirname(__DIR__).'/vendor/potherca/cli2web/web/index.php';

