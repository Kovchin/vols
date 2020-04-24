<?php

require_once '../core/DB.php';

//Настраиваем заголовок (запросы и ответы я отдаю в JSON формате)
//header('Content-Type: application/json');

//Получаем AJAX данные из POST запроса от файла ..\js\summ.js
$request = json_decode(file_get_contents('php://input'));

//определяем что делать в зависимости от секции что меняем
$section = $request->section;

$response = [
    'redirect' => false,
    'section' => $section,
    'fieldName' => $request->fieldName,
    'value' => $request->value
];

//Формируем перенаправление если меняется данные критичные для перестроения страницы 
/**
 * response = true,
 * url = адрес куда перенаправляется страница
 */
if ($section == 'notation' && $request->fieldName == 'CRQ') {
    $response['redirect'] = true;
    $response['url'] = '../pages/detail.php?crq=' . $request->value;
    echo json_encode($response);
    return;
} elseif ($section == 'initiator') {
    $response['redirect'] = true;
    $response['url'] = '../pages/detail.php?crq=' . $request->id;
} elseif ($section == 'agreement') {
    $response['url'] = '../pages/detail.php?crq=' . $request->id;
}


//======================================
//Глобальное условие что смотрит какой элемент секции изменяется
//======================================
if ($section == 'notation') {
    /**
     * Изменения и запросы для секции notation
     */
    //готовим запрос к базе данных и данные для него
    $sql = "UPDATE `fol_list` SET `$request->fieldName` = ? WHERE `id` = ?";
    $values = [$request->value, $request->idcrq];

    //Даем запрос к базе данных
    $db = new DB();
    $resultUpdate = $db->updateRow($sql, $values);
    $db->disconnect();
} elseif ($section == 'initiator') {
    /**
     * Изменения и запросы для секции initiator
     */
    //готовим запрос к базе данных и данные для него
    $sql = "SELECT `id` FROM `fol_working_process` WHERE `id_crq` = ? AND `flag` = 1";
    $values = [$request->idcrq];

    //Даем запрос к базе данных
    $db = new DB();

    //Проверяем есть ли такая запись в БД. Если есть то обновляем его данными из JSON объекта пришедших от fetch запроса со стороны клиента '../js.detail.php'
    if ($db->getRow($sql, $values)) {
        $sql = "UPDATE `fol_working_process` SET `$request->fieldName` = ?  WHERE `id_crq` = ? AND `flag` = 1";
        $values = [$request->value, $request->idcrq];
        $result = $db->updateRow($sql, $values);
    } else {
        //Если такой строки для изменения нет то добавляем ее в базу `fol_working_process`
        $sql = "INSERT INTO `fol_working_process` (`id_crq`,`id_counterparty`, `flag`) VALUE (?, ?, 1)";
        $values = [$request->idcrq, $request->value];
        $result = $db->insertRow($sql, $values);
    }
    $db->disconnect();
    $response['result'] = $result;
} elseif ($section == 'agreement') {
    if ($request->fieldName == null) {
        /**
         * Изменения и запросы для секции agreement
         * fieldName: null то есть добавление нового согласованта
         */
        //готовим запрос к базе данных и данные для него
        //Ловим есть ли такой контрагент в согласовании
        $sql = "SELECT `id` FROM `fol_working_process` WHERE `id_crq` = ? AND `id_counterparty` = ? AND `flag` = 2";
        $values = [$request->idcrq, $request->value];

        $db = new DB();
        $result = $db->getRow($sql, $values);
        $db->disconnect();

        if ($result) {
            //Если такая запись уже существует
            //$response['redirect'] = false;

            $response['sql'] = $sql;
            $response['values'] = $values;
        } else {
            //Если такой записи нет
            $sql = "INSERT INTO `fol_working_process` (`id_crq`,`id_counterparty`, `flag`) VALUE (?, ?, 2)";
            $values = [$request->idcrq, $request->value];


            $db = new DB();
            //Этот блок за один раз добавляет 2 записи в согласование и в заявку
            $result = $db->insertRow($sql, $values);
            $sql = "INSERT INTO `fol_working_process` (`id_crq`,`id_counterparty`, `flag`) VALUE (?, ?, 3)";
            $result = $db->insertRow($sql, $values);

            $db->disconnect();

            $response['redirect'] = true;
        }
    } else {
        /**
         * Если есть значение поля $request->fieldName то вносим изменения в действующие записи
         * ========================================================
         * Если на будущее буду обнулять даты согласования в случае отправки на доработку то это стоит делать тут
         * ========================================================
         */
        $sql = "UPDATE `fol_working_process` SET `$request->fieldName` = ?  WHERE `id_crq` = ? AND `id_counterparty` = ? AND `flag` = 2";
        $values = [$request->value, $request->idcrq, $request->idcounterparty];

        $db = new DB();
        $result = $db->updateRow($sql, $values);
        $db->disconnect();
    }
} else {
    $response['result'] = 'Пока не реализовано';
}


//Отладочные данные для выявления косяков при запросах к базе данных
$response['sql'] = $sql;
$response['values'] = $values;
//посылаем ответ его на клиента
echo json_encode($response);
