<?php
// error_reporting(0);
function tags2(){
global $db;
$res = $db->query("SELECT tag FROM `posting`");
$TampungData = array();
while($data_tags=$res->fetch_array()){
$tags = explode(',',strtolower(trim($data_tags['tag'])));
if(empty($data_tags['tag'])){echo'';}else{
foreach($tags as $val) {
$TampungData[] = $val;
}}}
$totalTags = count($TampungData);
$jumlah_tag = array_count_values($TampungData);
ksort($jumlah_tag);
if ($totalTags > 0) {
$output = array();
foreach($jumlah_tag as $key=>$val) {
$output[] = '<option value="'.$key.'">'.$key.'</options>';
}
$tags= implode(' ',$output);
return $tags;
}}

function tags3($id){
global $db;
$res = $db->query("SELECT tag FROM `posting` WHERE id_post=".$id);
$TampungData = array();
while($data_tags=$res->fetch_array()){
$tags = explode(',',strtolower(trim($data_tags['tag'])));
if(empty($data_tags['tag'])){echo'';}else{
foreach($tags as $val) {
$TampungData[] = $val;
}}}
$jumlah_tag = array_count_values($TampungData);
ksort($jumlah_tag);
$output = array();
foreach($jumlah_tag as $key=>$val) {
$output[] = '<option selected value="'.$key.'">'.$key.'</options>';
}

$tags= implode(' ',$output);
return $tags;
}
?>