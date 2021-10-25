<?php

function SelectRecordRepairCourse($table)
{


    $sql = "SELECT * FROM  $table
    WHERE  createdate >= '2021-09-09 00:00:00'";
    // xdebug_var_dump($sql);

    $rs = $GLOBALS["conn"]->query($sql);

    echo "<br> SelectRecordFromRepair $table <br>";



    /* foreach ($rs as $key => $value) {
        xdebug_var_dump($value);
    } */

    return $rs;
}


function createsqlCoursefun($result, $table, $pk, $isfk = "")
{

    //$i - count foreach
    global $modifyCoursefk;
    $i = 0;


    //create a lot of sql syntax
    foreach ($result as $key => $rs2) {


        /* xdebug_var_dump($rs2);
        die(); */


        // old primary key



        //must debug
        // xdebug_var_dump($rs2["pk"]);



        //create single sql syntax
        $echoSql = insertsqlsyntax($table, $rs2, $pk);

        echo "$echoSql<br>";


        if ($isfk == "pk") {
            $modifyCoursefk[$i]["ori_fk"] = $rs2["pk"];
            $modifyCoursefk[$i]["new_fk"] = $pk;
        }





        //  test record
        /* if ($number1 == 3) {
        break;
    } */
        $pk++;


        $i++;
    }

    //must debug
    // xdebug_var_dump($GLOBALS["modifyfk"]);
    // die();

    if ($isfk == "fk") {
        updatesqlCoursefun($table);
    }
}


function updatesqlCoursefun($table)
{


    global $modifyfk;
    global $modifyCoursefk;


    // must debug
    // xdebug_var_dump($modifyfk);




    $fkgp = ["contact" => $modifyfk, "course" => $modifyCoursefk];

    loopUpdatesqlfkfunction($table, $fkgp);
}

function loopUpdatesqlfkfunction($table, $modifyfkGroup)
{
    $i = 0;


    //create a lot of sql syntax
    // $i - count foreach
    foreach ($modifyfkGroup as $column_fk => $modifyfk) {


        foreach ($modifyfk as $i => $rs2) {

            updateCoursesqlsyntax($table, $rs2, $i,  $column_fk);
            $i++;
        }
    }
}
