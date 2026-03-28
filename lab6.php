<?php
function str_count($str, $substr): int {
    return substr_count($str, $substr);
}

echo str_count('hello', 'l'); 


function max_number(int $num): int {
    $digits = str_split((string)$num);
    rsort($digits);
    return (int)implode('', $digits);
}

echo max_number(123);


function no_space(string $str): string {
    return str_replace(' ', '', $str);
}

echo no_space("Hello World");
?>
