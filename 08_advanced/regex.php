<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/18/17
 * Time: 11:28
 */

/**
 * Виды:
 *
 * basic regular expressions (BRE) - чаще всего используется в UNIX утилитах по-умолчанию
 * extended regular expressions (ERE) - расширенный вариант
 * Perl-compatible regular expressions (PCRE) -  наиболее распространенный, богатый синтаксис
 *
 * PHP использует PCRE
 */


/**
 * Базовые правила:
 *
 * - болшинство символов соотвествутют самим себе
 * - символы [ ] \ / ^ $ . | ? * + ( ) { } являются специальными
 *
 * [] - границы символьного класса
 * () - границы подмаски
 * / - границы всего выражения
 * \ - экранирование спецсимвола
 * | - или
 * ^ - обозначение начала строки
 * $ - обозначение конца строки
 * . - любой символ, кроме \n (с модификатором /s учитывается и он)
 * + - ноль или больше вхождений предыдущиего символа или подмаски
 * ? - ноль или одно вхождение
 * * - одно или больше вхождений
 * {n1,n2} - от n1 до n2 вхождений, {0,} = *, {,1} = ?
 * (?#КОММЕНТАРИЙ) - комментарии внутри выражения, по аналогии с / * * / в PHP
 */

$match = 'hello';
//$result = preg_match('/^hello$/', $match);
//var_dump($result);

/**
 * Символьные классы
 *
 * - обозначают один символ
 * - обозначаются квадратными скобками []
 * - все спец.символы, кроме ^ (если вначале) здесь не действуют
 * - символ ^ вначале класса означает отрицание - [^a] = не а
 * - символ - использутеся для указания диапазона
 * - можно описывать диапазоны символов - [a-z] [а-я] [0-9] [A-ZА-Я0-9]
 * - можно перечислять конкретные символы - [abc12]
 */

$match = 'aaaBBbbbbCCcccDD--';
//$result = preg_match('/^[a-z0-9-]*$/i', $match);
//var_dump($result);

/**
 * Символ \
 *
 * \e - escape
 * \f - разрыв страницы
 * \n, \r, \t - перевод строки, возврат каретки и табуляция
 * \d - любой символ, означающий десятичную цифру
 * \D - любой символ, не означающий десятичную цифру
 * \s - любой пробельный символ
 * \S - не пробельный
 * \w - любая цифра, буква или знак подчеркивания
 * \W - любой символ, но не \w
 * \b - граница слова, ожно использовать вместо \w\W или \W\w или ^\w или \w$
 * \B - не граница слова
 *
 * \xHH - символ с шестнадцатиричным кодом HH
 * \DDD - символ с восьмиричным кодом DDD, или ссылка на подмаску
 */

$str = '12-12-2017';
//$result = preg_match('/^(\d{1,2})-\1-(\d{2,4})$/', $str, $matches);
//var_dump($matches);

/**
 * Ссылки на подмаску
 */

$str = 'hello11';
//$result = preg_match('/[helo]{5,}([0-9])\1/', $str);
//var_dump($result);



$regex = '/^
[a-z0-9._-]+ (?#  User name part)
@ (?# At)
[a-z]+ (?# Host name)
\.(
    com|net|ua (?# Domain name)
  ) 
$/ix';
$str = 'user.name@domain.com';
//$result = preg_match($regex, $str);
//var_dump($result);



/**
 * preg_match_all
 */
$matches = [1,2];
$str = 'hi there my name is User, my age is 18, my shirt is blue';
//$result = preg_match_all('/\w+\sis\s(\w+)/', $str, $matches = []);
//var_dump($matches);


$log = '
------
Date: 21-12-2016
Message: Error happened
------
Date: 13-12-2016
Message: Warning happened
------
Date: 15-12-2017
Message: Info happened
------
';
$matches = [];
//$result = preg_match_all('/date:\s([^\n]+)\nmessage:\s([^\n]+)/i', $log, $matches);
//var_dump($matches);
//
//$limit = time()-3600*24*7;
//foreach ($matches[1] as $key => $entry) {
//    $time = strtotime($entry);
//    if ($time > $limit) {
//        echo $matches[2][$key].PHP_EOL;
//    }
//}


/**
 * preg_replace
 */

$log = '
Date: 21-12-2016
Message: Error happened
------
Date: 13-12-2016
Message: Warning happened
------
Message: Warning happened
Date: 13-12-2016
------
Date: 15-12-2017
Message: Info happened
------
';
//$log = preg_replace(
//    [
//        '/date:\s([^\n]+)\nmessage:\s([^\n]+)\n[-]{6,6}/i',
//        '/message:\s([^\n]+)\ndate:\s([^\n]+)\n[-]{6,6}/i'
//    ],
//    ['\1: \2', '\1: \2'],
//    $log
//);
//var_dump($log);


$_cb = function ($matches) {
    return $matches[1].': '.$matches[2];
};

//$log = preg_replace_callback(
//    [
//        '/date:\s([^\n]+)\nmessage:\s([^\n]+)\n[-]{6,6}/i',
//        '/message:\s([^\n]+)\ndate:\s([^\n]+)\n[-]{6,6}/i'
//    ],
//    $_cb,
//    $log
//);
//var_dump($log);


/**
 * Модификаторы
 *
 * i - регистронезависимость
 * U - инвертирует жадность
 * m - многострочный поиск
 * s - если используется, то символ . соответствует и переводу строки
 * x - игнорировать пробелы/переносы строки (удобно для комментирования)
 *
 * Если поставить - перед подификатором, то эффект обратный (кроме U)
 */
//$str = '<div>
//<span>
//</span></div>';
//$result = preg_match_all('/^<.*>$/u', $str, $matches);
//var_dump($matches);




/**
 * Утверждения
 *
 * касательно последующего текста начинаются с
 *      (?= для положительных утверждений )
 *      (?! для отрицающих утверждений. )
 * касательно предшествующего текста начинаются с
 *      (?<= для положительных утверждений )
 *      (?<! для отрицающих. )
 */
//$str = 'fddbar';
//$result = preg_match('/(^foo)bar[^\s]+/', $str, $matches);
//var_dump($matches);


$str = 'apple';
//$result = preg_match('/^a(p|l)+e\s?(pie)?$/', $str);
//var_dump($result);


/**
 * Условные подмаски
 *
 * (?(condition)yes-pattern|no-pattern)
 *
 * (?(?=\d)u|p)
 */

$str = '0d';
$result = preg_match('/(?(?=\d)d|p)/', $str, $matches);
var_dump($matches);


