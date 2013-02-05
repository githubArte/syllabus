<?php
header("Content-Type:text/html; charset=utf-8");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Syllabus - syllables mixer</title>
    <style>
        body{ margin: 20px 20%; font-family: sans-serif; }
    </style>
</head>
<body>
    <h1>Syllabus - A syllables mixer</h1>
<p>
Really quick and dirty code to generate words based on sillables<br>
<br><a href="http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol">http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol</a><br>
gives all the combinations from 1 syllable to five sillables = count(array(do,re,mi,fa,sol))<br>
<br><a href="http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol&min=2">http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol&min=2</a><br>
gives all the combinations from 2 syllables to five sillables = count(array(do,re,mi,fa,sol))<br>
<br><a href="http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol&min=2&max=3">http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol&min=2&max=3</a><br>
gives all the combinations from 2 syllables to 3 sillables<br>
<br>
Note : <strong>'Ga Bu Zo Meu'</strong> from <a href="http://fr.wikipedia.org/wiki/Les_Shadoks">Les Shadoks</a><br>
Todo : Allow our script to create the words like BuBu (the sea) or ZoBuBuGa (to pump)<br>
Some code adapted from <a href="http://www.php.net/manual/en/function.shuffle.php#90615">php.net comments</a><br>
Code at : <a href="https://github.com/djacquel/syllabus">Github</a><br>
Tweeter : <a href="https://twitter.com/djacquel">@djacquel</a><br>
Licence : free<br>
</p>
<hr>
<h2>Input</h2>
<?php
// sillables used to composed words
if(isset($_GET['syllables'])){
    $sy = explode(',', $_GET['syllables']);
}else{
    $sy = array('ga', 'bu', 'zo', 'meu');
}

// min number of sillables used to compose word
$min = (int)$_GET['min'] ;
$min = $min > 0 ? $min : 1;

// max number of sillables used to compose word
$max = (int)$_GET['max'] ;
$max = $max > 0 ? $max : count($sy);

/**
 * mix syllables
 * some code from http://www.php.net/manual/en/function.shuffle.php#90615
 */

p('Syllables = ' . implode(', ', $sy));
p('min = ' . $min . ' - max = ' . $max);

$permutations = power_perms($sy, $min, $max);

$results = array();

foreach ($permutations as $permutation) {
    $results[] = implode('', $permutation);
}

usort($results, "cmp");
?>
<h2>Results</h2>
<?php
p('Result count = ' . count($results));
p();
p($results, true);

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
        $text .= PHP_EOL . '<br>';
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


?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38261653-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>