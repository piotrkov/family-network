<?php

require_once "NodeHandler.php";

$datebirthyear = "";
$datebirthmonth = "";
$datebirthday = "";
$datedeathyear = "";
$datedeathmonth = "";
$datedeathday = "";

if(isset($_GET['nodeid']) && !empty($_GET['nodeid']) && is_numeric($_GET['nodeid'])){
	$node = loadNodeData($_GET['nodeid'])['node'];	
	
	if(!empty($node['datebirth'])){
		$datebirth = explode("-", $node['datebirth']);
		$datebirthyear = $datebirth[0];
		$datebirthmonth = $datebirth[1];
		$datebirthday = $datebirth[2];
	}
	
	if(!empty($node['datedeath'])){
		$datedeath = explode("-", $node['datedeath']);
		$datedeathyear = $datedeath[0];
		$datedeathmonth = $datedeath[1];
		$datedeathday = $datedeath[2];
	}
	
}else{
	$node = array(
		'firstname' => "",
		'secondnames' => "",
		'surname' => "",
		'maidenname' => "",
		'datebirth' => "",
		'datedeath' => "",
		'photo' => "",
		'description' => "",
		'decade' => "",
		'id' => 0
	);
}


$errors = array (
		'firstname' => "",
		'secondnames' => "",
		'surname' => "",
		'maidenname' => "",
		'datebirth' => "",
		'datedeath' => "",
		'photo' => "",
		'description' => ""
	);

// HTTP method POST means that form was submitted. Only then we can process the data that was sent in it.
if($_SERVER["REQUEST_METHOD"] == "POST"){	
	
	$node['firstname'] = trim($_POST["firstname"]);
	$node['secondnames'] = trim($_POST["secondnames"]);
	$node['surname'] = trim($_POST["surname"]);
	$node['maidenname'] = trim($_POST["maidenname"]);
	if(!empty(trim($_POST["datebirthyear"])) && !empty(trim($_POST["datebirthmonth"])) && !empty(trim($_POST["datebirthday"]))){
		$datebirthyear = strlen(trim($_POST["datebirthyear"])) !=4 ? "1900": trim($_POST["datebirthyear"]);
		$datebirthmonth = strlen(trim($_POST["datebirthmonth"])) == 1 ? "0".trim($_POST["datebirthmonth"]) : trim($_POST["datebirthmonth"]);
		$datebirthday = strlen(trim($_POST["datebirthday"])) == 1 ? "0".trim($_POST["datebirthday"]) : trim($_POST["datebirthday"]);
		$node['datebirth'] = $datebirthyear."-".$datebirthmonth."-".$datebirthday;
	}
	
	if(!empty(trim($_POST["datedeathyear"])) && !empty(trim($_POST["datedeathmonth"])) && !empty(trim($_POST["datedeathday"]))){
		$datedeathyear = strlen(trim($_POST["datedeathyear"])) !=4 ? "1900": trim($_POST["datedeathyear"]);
		$datedeathmonth = strlen(trim($_POST["datedeathmonth"])) == 1 ? "0".trim($_POST["datedeathmonth"]) : trim($_POST["datedeathmonth"]);
		$datedeathday = strlen(trim($_POST["datedeathday"])) == 1 ? "0".trim($_POST["datedeathday"]) : trim($_POST["datedeathday"]);
		$node['datedeath'] = trim($_POST["datedeathyear"])."-".trim($_POST["datedeathmonth"])."-".trim($_POST["datedeathday"]);
	}
	if(isset($_POST["photo"])){
		$node['photo'] = trim($_POST["photo"]);
	}	
	$node['description'] = trim($_POST["description"]);
	$node['decade'] = calculateDecade(trim($_POST["datebirthyear"]));
	$node['id'] = trim($_POST["nodeId"]);
	
	$result = saveNodeData($node);
	if(!empty($result['errors'])){
		echo $result['errors'];
	}
}

require_once "NodeFormView.php";

function calculateDecade($year){
	//TODO: calculating decade - decide decades numeration system and format for date input on the form.
	return (int)($year/10);
}
?>