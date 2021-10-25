<?php
function insertsqlsyntax($table, $rs2, $pk)
{

    $len = count($rs2);

    //$number2 - count foreach
    $number2 = 0;
    $sql = "";
    $sql .= "INSERT INTO $table values(";
    foreach ($rs2 as $key1 => $rs3) {



        //have record
        if (isset($rs3) && strlen($rs3) > 0) {

            if ($key1 == "pk") {
                $sql .= "\"$pk\"";
            } else {
                $sql .= "\"$rs3\"";
            }

            // display null in database
        } else if ($rs3 === null) {
            $sql .= "null";
            // no any record in database
        } else if ($rs3 === "") {
            $sql .= "\"\"";
        }


        if ($number2 == 0) {
            // first
            $sql .=  ",";
        } else if ($number2 == $len - 1) {

            //last
            $sql .= ")";
        } else {
            $sql .=  ",";
        }



        $number2++;
    }




    $sql .= ";";

    executeQuery($sql);



    return $sql;
}
function findfksql()
{

    $sql = "SELECT TABLE_NAME,COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE COLUMN_NAME LIKE '%person_fk%'
    AND TABLE_SCHEMA='cloudsoft_emhk_repair'";
    /* $sql="SELECT TABLE_NAME, COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE COLUMN_NAME LIKE '%person_fk%'
    AND TABLE_SCHEMA = 'cloudsoft_emhk_repair'";

    $sql = "SELECT TABLE_NAME, COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE COLUMN_NAME LIKE '%_fk%'
    AND TABLE_SCHEMA = 'cloudsoft_emhk_repair'
    AND TABLE_NAME LIKE \"person%\"
    GROUP BY  TABLE_NAME"; */


    $rs =  $GLOBALS["conn"]->query($sql);

    return $rs;
}


function updatesqlsyntax($table, $modifyfk, $i,$column_fk)
{

    $ori_fk = $modifyfk[$i]["ori_fk"];
    $new_fk = $modifyfk[$i]["new_fk"];


    /* if ($table == "person_contact") {

        $sql1 = "UPDATE $table SET person_fk = $new_fk WHERE pk = $ori_fk;";
        executeQuery($sql1);
    } else {

        $sql = "UPDATE $table SET person_fk = $new_fk WHERE pk = $ori_fk;";
    } */
    $sql = "UPDATE $table SET $column_fk"."_fk = $new_fk WHERE $column_fk"."_fk = $ori_fk;";
    // xdebug_var_dump($sql);
    echo "<br>$sql<br>";


    executeQuery($sql);

    return $sql;
}

function  executeQuery($sql)
{

    /*  if ($GLOBALS["conn2"]->query($sql) === TRUE) {
            echo "<br>true ";
    } */
}

function findOriginRepair2MaxPK($table)
{

    $findID = "SELECT MAX( `pk` ) FROM $table";
    $findIDRs = $GLOBALS["conn2"]->query($findID);

    return $findIDRs;
}


function SelectRecordRepairsql($table)
{
    //new primary key
    $sql = "SELECT *
     FROM $table
     WHERE `createdate` >= '2021-09-09 00:00:00'";

    $result = $GLOBALS["conn"]->query($sql);

    return $result;
}


// course Module

function updateCoursesqlsyntax($table, $modifyfk, $i, $column_fk)
{

    $ori_fk = $modifyfk["ori_fk"];
    $new_fk = $modifyfk["new_fk"];



    $sql = "UPDATE $table SET $column_fk" . "_fk = $new_fk  WHERE $column_fk" . "fk = $ori_fk;";
    // xdebug_var_dump($sql);
    echo "<br>$sql<br>";
    executeQuery($sql);

    /*  $sql = "UPDATE $table SET course_fk = $modifyCoursefk[$i][\"new_fk\"] WHERE course_fk = $modifyCoursefk[$i][\"ori_fk\"];";
    // xdebug_var_dump($sql);
    echo "<br>$sql<br>"; */


    return $sql;
}


