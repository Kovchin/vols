<?

require_once '../core/DB.php';

//Получаем crq из того что мы навводили в pages/newwork.php
$crq = ($_POST['CRQ']);
$name = (htmlspecialchars($_POST['name']));
$date_of_work = ($_POST['date_of_work']);


$db = new DB();
$getRow = $db->getRow('SELECT `CRQ` FROM `fol_list` WHERE CRQ = ?', [$crq]);

if ($getRow != FALSE) {
    //Если такая CRQ есть в базе данных то мы возвращаемся на pages/newwork.php
    $new_url = '../pages/newwork.php';
    header('Location: ' . $new_url);
} else {
    //Если такого CRQ нет в базе данных то создаем такую запись и перенаправляем запрос в pages/detail.php

    //Тут толпа запросов для создания новой CRQ
    //В таблицу `fol_list`
    $insertRow = $db->insertRow("INSERT INTO `fol_list`(CRQ, name, date_of_work) VALUE(?, ?, ?)", [$crq, $name, ($date_of_work == '' ? $date_of_work = NULL : $date_of_work = $date_of_work)]);

    //Получаем id добавленной записи для создания хода работ в таблице `fol_working_process`
    $id_crq = $db->getRow('SELECT `id` FROM `fol_list` WHERE CRQ = ?', [$crq]);

    //Даем 6 запросов по умолчанию для заведения типового CRQ
    $db->insertRow("INSERT INTO `fol_working_process`(id_crq, id_counterparty, flag) VALUE(?, ?, ?)", [$id_crq['id'], 2, 2]);
    $db->insertRow("INSERT INTO `fol_working_process`(id_crq, id_counterparty, flag) VALUE(?, ?, ?)", [$id_crq['id'], 3, 2]);
    $db->insertRow("INSERT INTO `fol_working_process`(id_crq, id_counterparty, flag) VALUE(?, ?, ?)", [$id_crq['id'], 4, 2]);
    $db->insertRow("INSERT INTO `fol_working_process`(id_crq, id_counterparty, flag) VALUE(?, ?, ?)", [$id_crq['id'], 2, 3]);
    $db->insertRow("INSERT INTO `fol_working_process`(id_crq, id_counterparty, flag) VALUE(?, ?, ?)", [$id_crq['id'], 3, 3]);
    $db->insertRow("INSERT INTO `fol_working_process`(id_crq, id_counterparty, flag) VALUE(?, ?, ?)", [$id_crq['id'], 5, 3]);

    //Перенаправляем страницу на вновь созданный CRQ
    $new_url = '../pages/detail.php?crq=' . $crq;
    header('Location: ' . $new_url);
}

$db->disconnect();
