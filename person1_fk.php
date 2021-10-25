<?php
include 'conn.php';
include 'function.php';




$table = "person";
$pk = findMoveRepair1to2PK($table);
$rs = SelectRecordRepair($table);
createsqlfun($rs, $table, $pk, "pk");



$fk_table=findfk();

callpersonFkTable("person_address",$pk,$rs);
callpersonFkTable("person_customer_field",$pk,$rs);
callpersonFkTable("person_note",$pk,$rs);
callpersonFkTable("person_sys_log",$pk,$rs);
/* foreach($fk_table as $key =>$value){
    
    if($value["TABLE_NAME"]=="person"){
        continue;
    }else if($value["TABLE_NAME"]=="edm_list"){
        continue;
    }

    xdebug_var_dump($fk_table);
    die();
    callpersonFkTable($value["TABLE_NAME"],$pk,$rs);
}
 */
/* $table = "person_address";
$pk = findMoveRepair1to2PK($table);
$rs = SelectRecordRepairNoCreateDate($table);
createsqlfun($rs, $table, $pk, "fk");



$table = "person_customer_field";
$pk = findMoveRepair1to2PK($table);
$rs = SelectRecordRepairNoCreateDate($table);
createsqlfun($rs, $table, $pk, "fk");

$table = "person_note";
$pk = findMoveRepair1to2PK($table);
$rs = SelectRecordRepairNoCreateDate($table);
createsqlfun($rs, $table, $pk, "fk");

$table = "person_sys_log";
$pk = findMoveRepair1to2PK($table);
$rs = SelectRecordRepairNoCreateDate($table);
createsqlfun($rs, $table, $pk, "fk"); */




$conn->close();



$conn2->close();

function callpersonFkTable($table,$pk,$rs)
{
    $pk = findMoveRepair1to2PK($table);
    $rs = SelectRecordRepairNoCreateDate($table);
    createsqlfun($rs, $table, $pk, "fk");
}
