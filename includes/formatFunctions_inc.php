<?php

/**
 * Convert decimal point to comma and remove useless zero digits
 * @param $input
 * @return mixed
 */
function convertDecimalPoint($input)
{
    $float = (float)$input;
    return number_format($float,2,',',' ');
}
