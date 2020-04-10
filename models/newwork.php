<?

require_once '../core/DB.php';

//Получаем crq из того что мы навводили в pages/newwork.php
$crq = ($_POST['CRQ']);
$name = (htmlspecialchars($_POST['name']));
$date_of_work = ($_POST['date_of_work']);


$db = new DB();
$getRow = $db->getRow('SELECT `CRQ` FROM `fol_list` WHERE CRQ = ?', [$crq]);

if ($getRow != FALSE){
    //Если такая CRQ есть в базе данных то мы возвращаемся на pages/newwork.php
    $new_url = '../pages/newwork.php';
    header('Location: '.$new_url);
    }
else{
    //Если такого CRQ нет в базе данных то создаем такую запись и перенаправляем запрос в pages/detail.php
    $insertRow = $db->insertRow("INSERT INTO `fol_list`(CRQ, name, date_of_work) VALUE(?, ?, ?)" , [ $crq, $name, ($date_of_work == '' ? $date_of_work = NULL : $date_of_work = $date_of_work) ]);
    $new_url = '../pages/detail.php?crq='.$crq;
    header('Location: '.$new_url);
}

$db->disconnect();