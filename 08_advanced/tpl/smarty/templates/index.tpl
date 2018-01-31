{* this is a comment *}
<html>
<head>
    <title>Smarty</title>
</head>
<body>
    {include file='header.tpl'}
    <main>
        Hello, {$name|upper}! Your age is {$age}
        {insert name="getUncachedArea" data='hello'}
    </main>
    {include file='footer.tpl'}
</body>
</html>