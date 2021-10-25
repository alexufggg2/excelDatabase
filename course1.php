<?php
include 'conn.php';
include 'function.php';



$table = "person";
$pk = findMoveRepair1to2PK($table);
$rs = SelectRecordRepair($table);
createsqlfun($rs, $table, $pk, "pk");


$table = "course";
$pk = findMoveRepair1to2PK($table);
$rs = SelectRecordRepair($table);
createsqlCoursefun($rs, $table, $pk, "pk");



// $fk_table=findfk();

callpersonCourseFkTable("application", $pk, $rs);
callpersonCourseFkTable("application_status", $pk, $rs);





$conn->close();



$conn2->close();

function callpersonCourseFkTable($table, $pk, $rs)
{
    $pk = findMoveRepair1to2PK($table);
    $rs = SelectRecordRepairCourse($table);
    createsqlCoursefun($rs, $table, $pk, "fk");
}
