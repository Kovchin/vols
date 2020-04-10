<?
require_once '../models/detail.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Работы на ВОЛС №<?=$crq?></title>
</head>
<body>
    <header>
        <p class="logo">ОТС Сибири Droid</h1>
    </header>
    <main>
        <a class="button" href="summ.php">К списку работ на ВОЛС</a>

        <h1>Работы на ВОЛС № <?=$crq?></h1>
        <h2>Описание работ</h2>
        <table>
            <tr>
                <td>CRQ</td>
                <td>
                    <select name="" id="">
                        <?foreach($listCrq as $value){?>
                            <option value="<?=$value['CRQ']?>" <?=($value['CRQ'] == $crq ? 'selected': '')?>><?=$value['CRQ']?></option>
                        <?}?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Название работ</td>
                <td><textarea name="" id="" cols="30" rows="3"><?=$description['name']?></textarea></td>
            </tr>
            <tr>
                <td>Дата проведения работ</td>
                <td><input type="date" value=<?=$description['date_of_work']?>></td>
            </tr>
        </table>

        <h2>Инициатор работ</h2>

        <table>
            <tr>
                <td>Инициатор работ</td>
                <td>
                <select>
                    <?foreach ($listCounterparty as $value){?>
                        <option value="" <?=($value['id']== $id_counterparty ? 'selected':'')?>><?=$value['name']?></option>
                        <?}?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>email</td>
                <td><?=$initiator['email']?></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><?=$initiator['phone']?></td>
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
            <?foreach ($agreement as $value){?>
                <tr>
                <td><?=$value['name']?></td>
                <td><input type="date" value="<?=$value['data']?>"></td>
                <td><input type="checkbox" checked<?=($value['revision'] == ''? 'checked' : '')?>></td>
                <td><input type="text" value="<?=$value['revisionComment']?>"></td>
            </tr>
            <?};?>
    <tr>
    <td colspan=4><select name="" id="">
        <?foreach ($listCounterparty as $value){?>
            <option value=""><?=$value['name']?></option>
        <?}?>
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
    <?foreach($request as $value){?>
    <tr>
        <td>
            <?=$value['name']?>
        </td>
        <td><input type="date" value="<?=$value['date']?>"></td>
    </tr>
    <?}?>
    <tr>
        <td colspan=2>
            <select name="" id="">
                <?foreach ($listCounterparty as $value){?>
                    <option value=""><?=$value['name']?></option>
                <?}?>   
            </select>
        </td>
    </tr>
    <tr>
        <td>Заявка в АСУ РЭО</td>
        <td><input type="number" value="<?=$asu?>"></td>
    </tr>

</table>

<h2>Отмена работ</h2>

    <table>
        <tr>
            <td colspan=4>Отмена работ</td>
        </tr>
        <tr>
            <td>
                <select>
                    <?foreach ($smena as $value){?>
                        <option value="<?=$value['id']?>" <?=($canselledSmena == $value['surname'] ? 'selected' : '' )?>><?=$value['surname']?></option>
                    <?}?>
                </select>
            </td>
            <td>
                <select>
                    <?foreach ($listCounterparty as $value){?>
                        <option <?=($сancelled['name'] == $value['name'] ? 'selected' : '')?>><?=$value['name']?></option>
                    <?}?>
                </select>
            </td>
            <td>
                <input type="date" value="<?=$сancelled['data']?>">
            </td>
            <td>
                <textarea placeholder = "Причина отмены" id="" cols="10" rows="2"><?=$сancelled['revisionComment']?></textarea>
            </td>
        </tr>
        <tr> 
            <td colspan=4>Информирование об отмене</td>
        </tr>
        <tr>
            <td colspan=2>
                <select name="" id="">
                <?foreach ($smena as $value){?>
                        <option value="<?=$value['id']?>" <?=($сancelledNotification['surname'] == $value['surname'] ? 'selected' : '' )?>><?=$value['surname']?></option>
                    <?}?>
                </select>
            </td>
            <td colspan =2>
                <input type="date" value="<?=$сancelledNotification['data']?>">
            </td>
        </tr>
    </table>

    </main>
    <footer>
        <p>Все права защищены © Ковчин П.В.</p>
    </footer>
</body>
</html>