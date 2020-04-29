<?
require_once '../models/detail.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Работы на ВОЛС №<?= $crq ?></title>
</head>

<body>
    <header>
        <p class="logo">ОТС Сибири Droid</h1>
    </header>
    <main>
        <a class="button" href="summ.php">К списку работ на ВОЛС</a>

        <h1 id="idcrq" data-crq="<?= $crq ?>" data-idcrq="<?= $idcrq ?>">Работы на ВОЛС № <?= $crq ?></h1>
        <h2>Описание работ</h2>
        <table>
            <tr>
                <td>CRQ</td>
                <td>
                    <select data-fieldname="CRQ" data-section="notation" class="ajax">
                        <? foreach ($listCrq as $value) { ?>
                            <option value="<?= $value['CRQ'] ?>" <?= ($value['CRQ'] == $crq ? 'selected' : '') ?>><?= $value['CRQ'] ?></option>
                        <? } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Название работ</td>
                <td><textarea data-fieldname="name" data-section="notation" class="ajax" cols="30" rows="3"><?= $description['name'] ?></textarea></td>
            </tr>
            <tr>
                <td>Дата проведения работ</td>
                <td><input data-fieldname="date_of_work" data-section="notation" class="ajax" type="date" value=<?= $description['date_of_work'] ?>></td>
            </tr>
        </table>

        <h2>Инициатор работ</h2>

        <table>
            <tr>
                <td>Инициатор работ</td>
                <td>
                    <select data-fieldname="id_counterparty" data-section="initiator" class="ajax">
                        <? foreach ($listCounterparty as $value) { ?>
                            <option data-idcounterparty="<?= $value['id'] ?>" value="<?= $value['name'] ?>" <?= ($value['id'] == $id_counterparty ? 'selected' : '') ?>><?= $value['name'] ?></option>
                        <? } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>email</td>
                <td><?= $initiator['email'] ?></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><?= $initiator['phone'] ?></td>
            </tr>
        </table>

        <h2>Согласование</h2>

        <table>
            <tr>
                <th>Этап согласования</th>
                <th>Дата согласования</th>
                <th>Отправлени на доработку</th>
                <th>Причина отправки на доработку</th>
            </tr>
            <? foreach ($agreement as $value) { ?>
                <tr>
                    <td><?= $value['name'] ?></td>
                    <td><input data-idcounterparty="<?= $value['id_counterparty'] ?>" data-fieldName="data" data-section="agreement" class="ajax" type="date" value="<?= $value['data'] ?>"></td>
                    <td><input data-idcounterparty="<?= $value['id_counterparty'] ?>" data-fieldName="revision" data-section="agreement" class="ajax" type="checkbox" checked<?= ($value['revision'] == '' ? 'checked' : '') ?>></td>
                    <td><input data-idcounterparty="<?= $value['id_counterparty'] ?>" data-fieldName="revisionComment" data-section="agreement" class="ajax" type="text" value="<?= $value['revisionComment'] ?>"></td>
                </tr>
            <? }; ?>
            <tr>
                <td colspan=4><select data-section="agreement" class="ajax">
                        <? foreach ($listCounterparty as $value) { ?>
                            <option data-idcounterparty="<?= $value['id'] ?>" value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        </table>

        <h2>Заявка</h2>
        <table>
            <tr>
                <th>Этап согласования</th>
                <th>Дата согласования</th>
            </tr>
            <? foreach ($request as $value) { ?>
                <tr>
                    <td>
                        <?= $value['name'] ?>
                    </td>
                    <td><input data-idcounterparty="<?= $value['id_counterparty'] ?>" data-fieldName="data" data-section="application" class="ajax" type="date" value="<?= $value['data'] ?>"></td>
                </tr>
            <? } ?>

            <!--  Эту секцию убрал так как посчитали что добавление в этап согласования автоматически  подразумевает добавление в этап согласования заявки         <tr>
                <td colspan=2>
                    <select data-section="application" class="ajax">
                        <?/* foreach ($listCounterparty as $value) { ?>
                            <option data-idcounterparty="<?= $value['id'] ?>" value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
                        <? } */ ?>
                    </select>
                </td>
            </tr>-->
            <tr>
                <td>Заявка в АСУ РЭО</td>
                <td><input data-section="application" class="ajax" type="number" value="<?= $asu ?>"></td>
            </tr>

        </table>

        <h2>Отмена работ</h2>

        <table>
            <tr>
                <td colspan=4>Отмена работ</td>
            </tr>
            <tr>
                <td>
                    <select data-section="cancel" class="ajax">
                        <? foreach ($smena as $value) { ?>
                            <option value="<?= $value['surname'] ?>" <?= ($canselledSmena == $value['surname'] ? 'selected' : '') ?>><?= $value['surname'] ?></option>
                        <? } ?>
                    </select>
                </td>
                <td>
                    <select data-section="cancel" class="ajax">
                        <? foreach ($listCounterparty as $value) { ?>
                            <option data-idcounterparty="<?= $value['id'] ?>" <?= ($сancelled['name'] == $value['name'] ? 'selected' : '') ?>><?= $value['name'] ?></option>
                        <? } ?>
                    </select>
                </td>
                <td>
                    <input data-section="cancel" class="ajax" type="date" value="<?= $сancelled['data'] ?>">
                </td>
                <td>
                    <textarea data-section="cancel" class="ajax" placeholder="Причина отмены" cols="10" rows="2"><?= $сancelled['revisionComment'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan=4>Информирование об отмене</td>
            </tr>
            <tr>
                <td colspan=2>
                    <select data-section="cancel" class="ajax">
                        <? foreach ($smena as $value) { ?>
                            <option value="<?= $value['surname'] ?>" <?= ($сancelledNotifiфcation['surname'] == $value['surname'] ? 'selected' : '') ?>><?= $value['surname'] ?></option>
                        <? } ?>
                    </select>
                </td>
                <td colspan=2>
                    <input data-section="cancel" class="ajax" type="date" value="<?= $сancelledNotification['data'] ?>">
                </td>
            </tr>
        </table>

    </main>
    <footer>
        <p>Все права защищены © Ковчин П.В.</p>
    </footer>
    <script src="../js/fetch.js"></script>
    <script src="../js/detail.js"></script>
</body>

</html>