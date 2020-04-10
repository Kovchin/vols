<?php

require_once '../core/DB.php';
//require_once '../core/debug.php';

$crq = $_GET['crq'];

$db = new DB();

//Список всх crq
$listCrq = $db->getRows('SELECT `CRQ` FROM `fol_list` ORDER BY CRQ');

//Список всех контрагентов
$listCounterparty = $db->getRows('SELECT `id`,`name` FROM `fol_counterparty` ORDER BY id');

//Данные для заполнения первой секции
$description = $db->getRow('SELECT * FROM `fol_list` WHERE CRQ = ?',[$crq]);

//Получаем id текущей заявки из таблицы fol_list
$idcrq = $description['id'];

//Данные для заполнения второй секции
$initiator = $db->getRow('SELECT fol_working_process.id,
                                    fol_counterparty.id AS id_counterparty,
                                    fol_counterparty.name,
                                    fol_counterparty.phone,
                                    fol_counterparty.email
                            FROM `fol_working_process` 
                            JOIN fol_counterparty ON fol_counterparty.id = fol_working_process.id_counterparty WHERE id_crq = ? AND flag = 1',[$idcrq]);

//Получаем id инициатора текущих работ
$id_counterparty = $initiator['id_counterparty'];

//Данные для заполнения треттей секции
$agreement = $db->getRows('SELECT fol_counterparty.name,
                                    fol_working_process.data,
                                    fol_working_process.revision,
                                    fol_working_process.revisionComment
                             FROM `fol_working_process` 
                             JOIN   `fol_counterparty`
                             ON fol_counterparty.id = fol_working_process.id_counterparty
                             WHERE id_crq = ? AND flag = 2',[$idcrq]);

//Данные для заполнения четвертой секции
$request = $db->getRows('SELECT fol_counterparty.name,
                                fol_working_process.data
                        FROM `fol_working_process` 
                        JOIN `fol_counterparty`
                        ON fol_counterparty.id = fol_working_process.id_counterparty
                        WHERE id_crq = ? AND flag = 3',[$idcrq]);

$asu = $description['ASU'];

//Данные для заполнения пятой секции
//Данные для логирования действий в программе и за одно отображения в блоке отмена
$smena = $db->getRows('SELECT personel.id, personel.surname FROM `personel` WHERE id_role > 5 AND id_role < 12');

$сancelled = $db->getRow('SELECT fol_counterparty.name,
                            personel.surname,
                            fol_working_process.data,
                            fol_working_process.revisionComment
                            FROM `fol_working_process` 
                            JOIN `fol_counterparty`
                            ON fol_counterparty.id = fol_working_process.id_counterparty
                            JOIN `personel`
                            ON personel.id = fol_working_process.id_personel
                            WHERE id_crq = ? AND flag = 6',[$idcrq]);

$canselledSmena = $сancelled['surname'];

$сancelledNotification = $db->getRow('SELECT 
                            personel.surname,
                            fol_working_process.data
                            FROM `fol_working_process` 
                            JOIN `personel`
                            ON personel.id = fol_working_process.id_personel
                            WHERE id_crq = ? AND flag = 7',[$idcrq]);

//отладочный блок
//show($сancelledNotification);

$db->disconnect();
