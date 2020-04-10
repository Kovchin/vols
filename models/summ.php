<?
/*
!!!
TODO
Разобраться почему не работыет сортировка в $getRows через экранированные запросы!
!!!
*/

require_once '../core/DB.php';

//метод сортировки для sql запроса
$sort = $_GET['sort'];

//Устанавливаем метод сортировки по умолчанию
if ($sort == ''){
    $sort = 'id';
}

$db = new DB();

//Проблема здесь!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$getRows = $db->getRows("SELECT * FROM `fol_list` ORDER BY $sort");
//$getRows = $db->getRows("SELECT * FROM `fol_list` ORDER BY `?`", [$sort]);

$db->disconnect();