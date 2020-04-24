<?php

/**
 * Пипец как это все описать...
 * 
 * Это скрипт что обрабатывает AJAX запросы от формы 'pages\summ.php'
 * В этой форме подключен файл 'js\summ.js' что и вызывает запрос к данной форме
 * 
 * Используемые библиотеки
 * core\DB.php - доступ к моей библиотеке для работы с базами данных
 * js\fetch.js - fectch запросы к серверу
 * 
 * Все взаимодействия идут в JSON формате
 * 
 * Входные данные это ассоциативный массив 
 * 
 * crq - идентификатор работ
 * fieldname - название поля в таблице `fol_list` что изменяем 
 * value - новое значение
 * 
 * */

require '../core/DB.php';

//Настраиваем заголовок (запросы и ответы я отдаю в JSON формате)
header('Content-Type: application/json');

//Получаем AJAX данные из POST запроса от файла ..\js\summ.js
$request = json_decode(file_get_contents('php://input'));

//Формирование строки запроса
$sql = "UPDATE `fol_list` SET $request->fieldName = ? WHERE `CRQ` = ?";

//Подставляемы значения вместо вопросов
$values = [$request->value, $request->crq];

//Подключаемся к базе данных даем запрос и отключаемся от нее
$db = new DB();

$resultUpdate = $db->updateRow($sql, $values);

$db->disconnect();

$response = [
    //Отладочные данные в ответе от сервера, закомментировал что бы лишнего не светить структуру данных на сервере
    //'request' => $request,
    //'sql' => $sql,
    //'values' => $values,
    'resultUpdate' => $resultUpdate, //Если все успешно то ответ будет true берется из 'core\DB.php'
    'errorName' => 'no error',
    'errorNumber' => 0
];

//Посылаем ответ клиенту
echo json_encode($response);
