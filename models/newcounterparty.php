<?PHP

require_once '../core/DB.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

//Демонстрация корректного получения данных из post запроса
/**
 * echo 'name: ' . $name . '<br>';
 * echo 'phone: ' . $phone . '<br>';
 * echo 'email: ' . $email . '<br>';
 */

$sql = 'INSERT INTO `fol_counterparty`(name, phone, email) VALUE(?, ?, ?)';

// echo $sql;

$db = new DB();

$insertRow = $db->insertRow($sql, [$name, $phone, $email]);

$db->disconnect();

$new_url = '../pages/counterparty.php';
header('Location: ' . $new_url);
