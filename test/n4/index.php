<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrewm
 * Date: 12.07.2018
 * Time: 15:20
 */

/**
 * return sum of two digit string values
 * if parameter $safe is true and one of arguments contains non-digit symbol it return empty string;
 * @param string $arg1
 * @param string $arg2
 * @param bool $safe
 * @return string
 */
function sumString(string $arg1, string $arg2, bool $safe = true): string
{
    if ($safe && (preg_match('/[\D]/i', $arg1) || preg_match('/[\D]/i', $arg2))) {
        return '';
    }
    $top = $arg2;
    $down = $arg1;
    if (strlen($arg1) > strlen($arg2)) {
        $top = $arg1;
        $down = $arg2;
    };
    $top = array_reverse(str_split($top));
    $down = array_reverse(str_split($down));

    $accum = 0;
    $result = [];
    for ($i = 0; $i < count($top); $i++) {
        $value = intval($top[$i]) + intval($accum);
        if (isset($down[$i])) {
            $value += intval($down[$i]);
        }
        if ($value > 9) {
            list($accum, $value) = str_split(strval($value));
        } else {
            $accum = 0;
        }
        array_push($result, $value);
    }
    if ($accum != 0) array_push($result, $accum);
    return implode(array_reverse($result));
}

function getSumAndCheckStr($arg1, $arg2, $result, $safe = true)
{
    $val = sumString($arg1, $arg2, $safe);

    $l = " result of sum $arg1 and $arg2 is : '$val' ";
    if ($result === $val) {
        $l .= " which is expected";
    } else {
        $l .= " which is not expected. expect: $result";
    }
    return $l;
}

echo "<br>" . getSumAndCheckStr('1aaaaaaagt9', '192397658748', '202397658757', false);
echo "<br>" . getSumAndCheckStr('1aaaaaaagt9', '192397658748', '', true);
echo "<br>" . getSumAndCheckStr('114441118899', '192397658748', '306838777647');
echo "<br>" . getSumAndCheckStr('9890284092384092389482304', '76782647623874628746827326472831', '76782657514158721130919715955135');

