<?

/*===================================
Страница для тестирования методов класса DB
===================================*/

    require_once '../core/DB.php';

    //Функция для красивого отображения объектов/массивов
    function show($value){
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    };

    $test = new DB ();

    //получение одной записи
    $getRow = $test->getRow("SELECT * FROM `fol_list` WHERE `id` = ?",["1"]);
    //получение группы записей
    $getRows = $test->getRows("SELECT * FROM `fol_list` WHERE `compleate` = ?",[true]);
    //добавление данных в БД
    $insertRow = $test->insertRow("INSERT INTO fol_list(CRQ, name) VALUE(?, ?)",['1593951','Созданные работы']);
    //обновление данных в таблице
    $updateRow = $test->updateRow("UPDATE `fol_list` SET `name` = ? WHERE `id` = ?",["Что это за работы", "1"]);
    //удаление данных из таблицы
    $deleteRow = $test->deleteRow("DELETE FROM `fol_list` WHERE `name` = ?",["Созданные работы"]);

    //отображение результата выполнения комманды
    show($getRow);
    show($getRows);
    show($insertRow);
    show($updateRow);
    show($deleteRow);

    //отключение от базы данных
    $test->disconnect();