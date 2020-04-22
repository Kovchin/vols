<?php

require_once '../core/DB.php';

//Настраиваем заголовок (запросы и ответы я отдаю в JSON формате)
header('Content-Type: application/json');

//Получаем AJAX данные из POST запроса от файла ..\js\counterparty.js
$request = json_decode(file_get_contents('php://input'));

//Готовим данные для обращения к безе
$fieldName = trim(htmlspecialchars($request->fieldName));
$value = trim(htmlspecialchars($request->value));
$name = trim(htmlspecialchars($request->name));

//sql запрос
$sql = "UPDATE `fol_counterparty` SET $fieldName = ? WHERE `name` = ?";
//значения подставляемых полей
$values = [$value, $name];

//Подулючаемся к базе данных вносим изменения и отключаемся от нее
$db = new DB();
$resultUpdate = $db->updateRow($sql, $values);
$db->disconnect();

//Формируем ответ от сервера
$response = [
    //    'sql' => $sql,
    //    'values' => $values,
    //    'request' => $request,
    'resultUpdate' => $resultUpdate,
    'errorName' => 'no error',
    'errorNumber' => 0
];

echo json_encode($response);
