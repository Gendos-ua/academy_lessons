<?php
error_reporting(-1);
ini_set('display_errors', 1);

#Comment
ob_start();

//Comment

/*
 * Multiline comment
 */

$color1 = 'red';
$COLOR2 = "blue";

$number1 = 1;
$double = 1.1;

$good = true;
$bad = false;
$null = null;

$emptyString = '';
$zero = 0;

// Ref
$colorRef = &$color1;
unset($color1);
//echo $colorRef;


// Var var
$color = 'blue';

$$color = 'RED';

//echo $blue;

unset($$color);

// Constants
define('MY_CONST', 1);
defined('MY_CONST');
/*
echo __FILE__, PHP_EOL;
echo __LINE__, PHP_EOL;
echo __DIR__, PHP_EOL;

echo PHP_EOL . "\r\n";
echo DIRECTORY_SEPARATOR, "<br>";
*/

// Cast
$age1 = 4;
$age2 = 10;


$name1 = ('Vasia'.' P.');

$name2 = $name3 = 'Kolya';

$var1 = ($age1 == 4 ? 2 : 3);


?>
<table bgcolor="#f5f5dc" border="1">
<?php

    echo "<tr>";

    if ($name1 == 'Vasia'):

        echo "<td>$name1</td>";

    elseif ($name2 == 'Kolya'):

        echo "<td>$name2</td>";

    else:

        echo "<td>Not Vasya</td>";

    endif;

    echo "</tr>";

?>
</table>
<?php


// Switch

$test = 10;

if ($test == 8):

elseif ($test == 2):

endif;

switch ($test):
    case 8:
    case 9:
    case 10:
    case 11:
        break;
    default: {
        echo 'test not found';
        break;
    }
endswitch;




if (true) {
    echo '3';
} else {
    echo '2';
}























