<?php

$words = array('aap', 'aad');//, 'citroen', 'citrus');

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

    $handledWords = array();
    $groups = array();

    foreach ($input as $word) {
        $tmpString = '';
        $bestMatchedStringFrontGroup = '';
        $bestMatchedStringBackGroup = '';

        for ($i = 0; $i < strlen($word); $i++) {
            $tmpString .= substr($word, $i, 1);

            foreach ($handledWords as $hw) {
                if (strpos($hw, $tmpString) == 0) {
                    $bestMatchedStringFrontGroup = $tmpString;
                } elseif (strpos($hw, $tmpString) == strlen($hw) - strlen($tmpString)) {
                    $bestMatchedStringBackGroup = $tmpString;
                }
            }
        }

        if (!in_array($word, $handledWords)) {
            $handledWords[] = $word;
        }
        if ($bestMatchedStringFrontGroup != '') {
            if (!in_array($bestMatchedStringFrontGroup, $groups)) {
                $groups[] = $bestMatchedStringFrontGroup;
            }
        }
    }

    var_dump($groups);

    return sprintf('/^%s$/', implode('|', $input));
}