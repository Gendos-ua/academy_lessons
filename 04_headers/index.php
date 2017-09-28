<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/25/17
 * Time: 15:54
 */

/**
 * Типы заголовков:
 *
 * General (Общие):
 *      Connection - сведения о соединении
 *      Date - дата генерации ответа
 *      Transfer-Encoding - список типов кодирования контента
 *      Upgrade - протоколы поддерживаемые клиентом
 *      Cache-Control - директивы управления кешем
 *      Pragma - опции (обычно no-cache)
 *
 * Request (Запрос)
 *      Accept - список поддерживаемых MIME типов ответа
 *      Accept-Charset - список поддерживаемых кодировок ответа
 *      Accept-Encoding - список поддерживаемых способов кодирования
 *      Accept-Language - список поддерживаемых языков
 *      Content-Type - MIME тип тела запроса (для PUT и POST методов)
 *      Content-Length - длина тела запроса
 *      Host - доменное имя запрашиваемого ресурса
 *      If-Modified-Since - выполнять запрос только если ресурс
 *          был изменен с момента передаваемой даты
 *      If-Unmodified-Since - *
 *          не был изменен с момента передаваемой даты
 *      Referer - URI ресурса с которого клиент делает текущий запрос
 *      User-Agent - строка-идентификатор клиента, формат для браузеров:
 *
 *          Mozilla/<version> (<system-information>) <platform> (<platform-details>) <extensions>
 *
 *      Авторизация:
 *      Authorization - Basic base64(username:password)
 *
 *
 * Response (Ответ)
 *      Content-Type: MIME тип ответа
 *      X-Content-Type-Options: nosniff; - запрет браузеру менять Content-Type
 *      WWW-Authenticate - тип HTTP авторизции (обычно - basic realm="Текст для пользователя")
 *      Age - количество секунд с момента модификации ресурса
 *      Content-Length - длина тела ответа
 *      Allow - список поддерживаемых сервером HTTP методов
 *      ETag - тег (уникальный) ресурса в рамках сайта
 *      Expires - дата истечения срока актуальности
 *      Cache-Control - директивы кеширования
 *             public - можно кешировать публично
 *             private - можно кешировать только для текущего пользователя
 *             no-cache - нельзя кешировать
 *             no-store - нельзя кешировать
 *             max-age=3600 - можно кешировать на N секунд с момента запроса
 *             must-revalidate - перед использованием кеша нужно првоерить
 *                  его валидность запросом If-Modified-Since
 *
 *      X-Frame-Options - разрешать ли отображать ресурс в iframe
 *              DENY - запрещать
 *              SAMEORIGIN - только на страницах с этим же доменом
 *              ALLOW-FROM https://example.com/ - разрешать на конкретном сайте
 *
 *
 *
 *
 */

$user = 'admin';
$password = '123456';

if ($user !== $_SERVER['PHP_AUTH_USER']
    || $password !== $_SERVER['PHP_AUTH_PW']
) {
    header(
        'WWW-Authenticate: basic realm="Войдите чтобы увидеть контент"',
        false,
        401
    );
    echo 'Вы не авторизованы.';
    exit;
}


session_start([]);


#$file = 'pdf.pdf';
#header('Content-Type: application/pdf;');
#header('Content-Disposition: attachment');
#readfile($file);

#$file = 'image.jpg';
#header('Content-Type: image/jpeg;');
#readfile($file);


#header('Foo: bar');
#header('Foo: baz', false);
#header('Content-Type: image/jpeg');
#header('Content-Type: image/png', false);


$file = __FILE__;
$last_modified_time = filemtime($file)+3600;
$etag = md5_file($file);

/*
header(
    "Expires: "
    .gmdate("D, d M Y H:i:s", $last_modified_time)
    ." GMT"
);
*/


/*
$status = 200;
if ($_SERVER['HTTP_IF_NONE_MATCH'] === $etag) {
    $status = 304;
}
header("Etag: $etag", true, $status);

if ($status == 304) {
    return;
}
*/


//header('Content-Type: text/plain');
header('Cache-Control: no-store, must-revalidate');
header('Pragma: no-cache');
//header('Content-Disposition: attachment; filename=dl.txt');
header("Etag: $etag");


setcookie(
    'SESSID',
    '2',
    time()+60*60*24,
    '/',
    $_SERVER['SERVER_NAME'],
    false,
    true
);

//setcookie('my_cookie', '', 1);


/*?><iframe src="frame.php" style="display: none"></iframe><?*/


//print_r(apache_request_headers());
//print_r($_SERVER);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['name'] = $_POST['user_name'];
}

$_SESSION['auth'] = true;

print_r($_SESSION);

?>
<form method="post">
    <input name="user_name"
           value="<?=($_SESSION['name'] ?: '')?>">
    <button>send</button>
</form>

<?














exit;


$file = __FILE__;
$last_modified_time = filemtime($file);
$etag = md5_file($file);

header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");
header("Etag: $etag");

if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time ||
    trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag
) {
    header("HTTP/1.1 304 Not Modified");
    exit;
}

header('WWW-Authenticate: digest realm="Access to the staging site"', false, 401);

