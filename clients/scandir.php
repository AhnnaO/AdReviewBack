<?php
session_start();


$client = $_GET["client"];
$campaign = $_GET["campaign"];
$adtype = $_GET["adtype"];
$version = $_GET["version"];
$size = $_GET["size"];


if($_SESSION["user"] == "admin") {

    $path = "./".$client."/".$campaign."/".$adtype."/".$version."/".$size;
    $scanned_directory = array_diff(scandir($path), array('..', '.', 'scandir.php', '.DS_Store'));
    $returnArray=array();

foreach($scanned_directory as $key=>$value){
    $returnArray[$value] = $value;
}
echo json_encode($returnArray);
}

$path = "./".$client."/".$campaign."/".$adtype."/".$version;
$scanned_directory = array_diff(scandir($path), array('..', '.', 'scandir.php', '.DS_Store'));

$returnArray=array();

foreach($scanned_directory as $key=>$value){
    $returnArray[$value] = $value;
}
echo json_encode($returnArray);

?>