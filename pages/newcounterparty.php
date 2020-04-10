<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Создать контрагента</title>
</head>
<body>
    <header>
        <p class="logo">ОТС Сибири Droid</h1>
    </header>

    <main>
        <h1>Добавить нового контрагента</h1>
        <a class="button" href="summ.php">К списку работ на ВОЛС</a>
        <a class="button" href="counterparty.php">К списку контрагентов</a>
        <form action="../models/newcounterparty.php" method="post">
            <input type="text" placeholder="Имя" required name="name">
            <input type="text" placeholder="Телефон" required name="phone">
            <input type="text" placeholder="Email" required name="email">
            <input type="submit" value="Добавить">
        </form>
    </main>

    <footer>
        <p>Все права защищены © Ковчин П.В.</p>
    </footer>
</body>
</html>