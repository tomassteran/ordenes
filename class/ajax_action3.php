<?php
include_once '../config/Database.php';
include_once 'Records3.php';

$database = new Database();
$db = $database->getConnection();

$record = new Records($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
	$record->listRecords();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {	
	$record->ordenp = $_POST["ordenp"];
	$record->name = $_POST["name"];
    $record->age = $_POST["age"];
    $record->skills = $_POST["skills"];
	$record->address = $_POST["address"];
	$record->designation = $_POST["designation"];
	$record->categoria = $_POST["categoria"];
	$record->addRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$record->id = $_POST["id"];
	$record->getRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
	$record->id = $_POST["id"];
	$record->ordenp = $_POST["ordenp"];
	$record->name = $_POST["name"];
    $record->age = $_POST["age"];
    $record->skills = $_POST["skills"];
	$record->address = $_POST["address"];
	$record->designation = $_POST["designation"];
	$record->categoria = $_POST["categoria"];
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
?>