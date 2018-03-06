<?php

return [
  'arguments' => [
    [
      'autocomplete' => '!'.__DIR__.'/typo-lists/typo-list.php',
      'default' => '',
      'description' => 'Select a typo from the list or invent one yourself',
      // @NOTE: Attribute `placeholder` is only allowed when the input type is 
      //        email, number, password, search, tel, text, or url.
      'example' => 'Spellng misaake', // for documentation and placeholder attribute
      'label' => false,               // `false` or empty string '' for NO label
      'name' => 'search-term',        //
      'type' => 'text',               // For validation and <INPUT> shape
    ],
  ],
  'options' => [
    [
      'description' => '',
      'name'        => 'false-positives-threshold',
      'default'     => 3,
      'type'        => 'number'
    ],
  ],
  'flags' => [
    ['name' => 'show-duplicates', 'description' => ''],
    ['name' => 'show-false-positives', 'description' => ''],
    ['name' => 'skip-typo-check', 'description' => ''],
  ],
];
