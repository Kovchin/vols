<?

require_once '../core/DB.php';

$db = new DB();

$getRows = $db->getRows("SELECT * FROM `fol_counterparty`");

$db->disconnect();