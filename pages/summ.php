<?

require_once '../models/summ.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Document</title>
</head>

<body>
    <header>
        <p class="logo">ОТС Сибири Droid</h1>
    </header>

    <main>
        <h1>Согласование работ на ВОЛС</h1>

        <a class="button" href="./newwork.php">Регистрация работы</a></button>
        <a class="button" href="./counterparty.php">Список контрагентов</a></button>
        <div class="summMain">
            <table>
                <!--
            Шапка таблицы
            -->
                <tr>
                    <th><a href="?sort=CRQ">№ CRQ</a></th>
                    <th><a href="?sort=name">Наименование работы по ТК</a></th>
                    <th><a href="?sort=agreed">Работы согласованы</a></th>
                    <th><a href="?sort=compleate">Работы выполнены</a></th>
                    <th><a href="?sort=date_of_work">Дата проведения работ</a></th>
                </tr>
                <!--
            формирование самой таблицы
            -->
                <? foreach ($getRows as $value) { ?>
                    <tr>
                        <td><?= $value['CRQ'] ?></td>
                        <td><a href="detail.php?crq=<?= $value['CRQ'] ?>"><?= $value['name'] ?></a></td>
                        <td><input class="ajax" data-fieldName="agreed" data-crq="<?= $value['CRQ'] ?>" type="checkbox" <?= ($value['agreed'] == '1' ? 'checked="true"' : '') ?>></td>
                        <td><input type="checkbox" disabled <?= ($value['compleate'] == '1' ? 'checked = "true"' : '') ?>></td>
                        <td><input class="ajax" data-fieldName="date_of_work" data-crq="<?= $value['CRQ'] ?>" type="date" value="<?= $value['date_of_work'] ?>"></td>
                    </tr>
                <? }; ?>
            </table>
        </div>

    </main>

    <footer>
        <p>Все права защищены © Ковчин П.В.</p>
    </footer>

    <script src="../js/fetch.js"></script>
    <script src="../js/summ.js"></script>
</body>

</html>