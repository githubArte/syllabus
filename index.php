<?php
header("Content-Type:text/plain; charset=utf-8");

if(isset($_get['syllabes'])){
    $sy = explode(',', $_get['syllabes']);
}else{
    $sy = array('li', 'ne', 'noo', 'mi', 'paï', 'ka');
}


$syllabes = isset($_get['syllabes']) ? explode(','$_get['syllabes']) : array('li', 'ne', 'noo', 'mi', 'paï', 'ka') ;


/**
 * mix syllables
 * some code from http://www.php.net/manual/en/function.shuffle.php#90615
 */
$syllables = array('li', 'ne', 'noo', 'mi', 'paï', 'ka');

$minLength = 3;
$maxLength = 4;

p('Syllabes = ' . implode(', ', $syllables));
p();

$permutations = power_perms($syllables, $minLength, $maxLength);

$results = array();

foreach ($permutations as $permutation) {
    $results[] = implode('', $permutation);
}

usort($results, "cmp");

p($results, true);

p();
p();

function p($text = '', $withNumber = false) {
    
    static $count;

    if (is_array($text)) {
        foreach ($text as $val) {
            if (is_array($val)) {
                p(implode('', $val), $withNumber);
            } else {
                p($val, $withNumber);
            }
        }
    } else {
        $text .= PHP_EOL;
        if($withNumber == true){
            echo ++$count . ' - ' . $text;
        }else{
            echo $text;
        }
    }
}

function power_perms($arr, $minLength = 1, $maxLength = 10) {
    $power_set = power_set($arr, $minLength, $maxLength);
    $result = array();
    foreach ($power_set as $set) {
        $perms = perms($set);
        $result = array_merge($result, $perms);
    }
    return $result;
}

function power_set($in, $minLength = 1, $maxLength = 10) {

    $count = count($in);
    $members = pow(2, $count);
    $return = array();
    for ($i = 0; $i < $members; $i++) {
        $b = sprintf("%0" . $count . "b", $i);
        $out = array();
        for ($j = 0; $j < $count; $j++) {
            if ($b{$j} == '1')
                $out[] = $in[$j];
        }
        if (count($out) >= $minLength && count($out) <= $maxLength) {
            $return[] = $out;
        }
    }

    return $return;
}

function factorial($int) {
    if ($int < 2) {
        return 1;
    }

    for ($f = 2; $int - 1 > 1; $f *= $int--)
        ;

    return $f;
}

function perm($arr, $nth = null) {

    if ($nth === null) {
        return perms($arr);
    }

    $result = array();
    $length = count($arr);

    while ($length--) {
        $f = factorial($length);
        $p = floor($nth / $f);
        $result[] = $arr[$p];
        array_delete_by_key($arr, $p);
        $nth -= $p * $f;
    }

    $result = array_merge($result, $arr);
    return $result;
}

function perms($arr) {
    $p = array();
    for ($i = 0; $i < factorial(count($arr)); $i++) {
        $p[] = perm($arr, $i);
    }
    return $p;
}

function array_delete_by_key(&$array, $delete_key, $use_old_keys = FALSE) {

    unset($array[$delete_key]);

    if (!$use_old_keys) {
        $array = array_values($array);
    }

    return TRUE;
}

function cmp($a, $b) {
    if (strlen($a) == strlen($b)) {
        return 0;
    }
    return (strlen($a) < strlen($b)) ? -1 : 1;
}


