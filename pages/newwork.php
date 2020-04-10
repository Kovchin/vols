<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Регистрация работ</title>
</head>
<body>
    <header>
        <p class="logo">ОТС Сибири Droid</h1>
    </header>
    <main>
    <h1>Регистрация новых работ на ВОЛС</h1>
        <a class="button" href="summ.php">К списку работ на ВОЛС</a>
            <form action="../models/newwork.php" method="post">
                <input name = "CRQ" type="number" placeholder="Номер CRQ" required>
                <textarea name = "name" id="" cols="30" rows="10" placeholder = "Краткое описание работ" required></textarea>
                <input type="date" placeholder = "Дата работ" name="date_of_work">
                <input type="submit" value="Завести работы">
            </form>
    </main>
    <footer>
        <p>Все права защищены © Ковчин П.В.</p>
    </footer>
</body>
</html>