<?php

$words = array('aap', 'banaan', 'citroen', 'citrus');

$regexp = makeRegExp($words);

var_dump($words);

echo '<h3>' . $regexp . '</h3>';

foreach ($words as $word) {
    echo $word . ' = ' . (preg_match($regexp, $word) ? 'true' : 'false') . '<br>';
}

/**
 * @param $input
 * @return string
 */
function makeRegExp($input) {
    return sprintf('/^%s$/', implode('|', $input));
}