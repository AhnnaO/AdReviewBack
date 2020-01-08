<?php

$client = $_GET["client"];
$campaign = $_GET["campaign"];
$adtype = $_GET["adtype"];

$path = "./".$client."/".$campaign."/".$adtype;
$scanned_directory = array_diff(scandir($path), array('..', '.', 'scandir.php', '.DS_Store'));
//print_r(json_encode($scanned_directory));

$returnArray=array();

foreach($scanned_directory as $key=>$value){
    $returnArray[$value] = $value;
}
echo json_encode($returnArray);
?>