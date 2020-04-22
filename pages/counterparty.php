<?
require_once '../models/counterparty.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Список контрагентов</title>
</head>

<body>
    <header>
        <p class="logo">ОТС Сибири Droid</h1>
    </header>

    <main>
        <h1>Список контрагентов</h1>
        <a class="button" href="../pages/summ.php">К списку работ</a>
        <a class="button" href="../pages/newcounterparty.php">Добавить контрагента</a>

        <table>
            <!--
            Шапка таблицы
            -->
            <tr>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Email</th>
            </tr>
            <!--
            формирование самой таблицы
            -->
            <? foreach ($getRows as $value) { ?>
                <tr>
                    <td><input data-fieldName="name" data-name="<?= $value['name'] ?>" class="ajax" type="text" value="<?= $value['name'] ?>" <?= ($value['id'] < 10 ? 'disabled' : '') ?>></a></td>
                    <td><input data-fieldName="phone" data-name="<?= $value['name'] ?>" class="ajax" type="text" value="<?= $value['phone'] ?>" <?= ($value['id'] == 1 ? 'disabled' : '') ?>></td>
                    <td><input data-fieldName="email" data-name="<?= $value['name'] ?>" class="ajax" type="text" value="<?= $value['email'] ?>" <?= ($value['id'] == 1 ? 'disabled' : '') ?>></td>
                </tr>
            <? }; ?>
        </table>

    </main>

    <footer>
        <p>Все права защищены © Ковчин П.В.</p>
    </footer>
    <script src="../js/fetch.js"></script>
    <script src="../js/counterparty.js"></script>
</body>

</html>