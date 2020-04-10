<?

require_once '../core/debug.php';
require_once '../core/DB.php';

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);

//show($name);
//show($phone);
//show($email);

$db = new DB();

$insertRow = $db->insertRow("INSERT INTO `fol_counterparty`(`name`, `email`, `phone`) VALUE(?, ?, ?)" , [ $name, $email, $phone]);

$db->disconnect();

$new_url = '../pages/counterparty.php';
header('Location: '.$new_url);
