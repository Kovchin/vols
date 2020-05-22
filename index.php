<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ВОЛС</title>
</head>

<body>

    <a href='./pages/summ.php'>Итоги</a>

    <!--Форма для загрузки файлов на сервер-->

    <form action="/core/upload.php" method="post" enctype="multipart/form-data">

        <input type="file" name="file">

        <input type="submit" value="Отправить">

    </form>

    <!--
    Множественная загрузка файлов
        
<form action="/upload.php" method="post" enctype="multipart/form-data">

	<input type="file" name="file[]" multiple>

	<input type="submit" value="Отправить">

</form>

    -->

</body>

</html>