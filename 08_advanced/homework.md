
1. Дана строка содержащая HTML. Получите все ссылки в этой строке в виде массива (значение атрибутов href="" и src=""). Учтите, что названия атрибутов может быть в разных регистрах, так же может быть пробел между названием и символом `=`.

2. Дана строка содержащая переменные PHP. Оберните все переменные в HTML тег `<b>`
   
   Примеры:
   
   `текст $var текст` > `текст <b>$var</b> текст`
   
   `текст $data["key"] текст` > `текст <b>$data["key"]</b> текст`
   
3. Дана строка - ссылка на сайт, получить из нее домен. 
   
   Примеры:
   
   `https://site.com` > `site.com`
   
   `http://sub.some-site.com.ua/some/page.html` > `sub.some-site.com.ua`
   
4. Замените в строке двойную звездочку на `!`, не трогая одиночные звездочки и те, которые состоят в группе больше двух
    
    Примеры:
    
    `** some ** message *` > `! some ! message *`
    
    `another *** message *` > `another *** message *`
    
5. Удалить идущие подряд (через пробел, 1 или больше) два и более одинаковых слова, причем так, чтобы не осталось пробелов лишних (двойных) пробелов. Считайте все слова состоящими из маленьких латинских букв.

   Примеры:
   
   `we we are the the champions` > `we are the champions`
   `hello hello world` > `hello world`