<?php
include 'sql.php';
//for test record


// person module
function findMoveRepair1to2PK($table)
{

    $findIDRs = findOriginRepair2MaxPK($table);

    foreach ($findIDRs  as $key => $rs) {


        $pk = (int)$rs["MAX( `pk` )"];
        $pk += 1;
        // die();
    }

    return $pk;
}


function SelectRecordRepair($table)
{

    $result = SelectRecordRepairsql($table);

    return $result;
    // echo "<br>"

}

function createsqlfun($result, $table, $pk, $isfk = "")
{

    //$i - count foreach
    global $modifyfk;
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
            $modifyfk[$i]["ori_fk"] = $rs2["pk"];
            $modifyfk[$i]["new_fk"] = $pk;
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
        updatesqlfun($table);
    }
}



function findfk()
{



    $rs =  findfksql();

    $onlyshowTableArr = [];
    foreach ($rs  as $key => $value) {

        // must debug
        // xdebug_var_dump($value);
        $onlyshowTableArr[] = $value;

        /*  if ($value["COLUMN_NAME"] !== "person_fk") {
        continue;
    } */
        /*  $str = $value["TABLE_NAME"];
        $pattern = "/^person/i";
        if (preg_match($pattern, $str) == 1) {
            xdebug_var_dump($value);

            if (in_array("person_address", $value)) {
                $onlyshowTableArr[] = $value;
            }
            if (in_array("person_customer_field", $value)) {
                $onlyshowTableArr[] = $value;
            }
            if (in_array("person_note", $value)) {
                $onlyshowTableArr[] = $value;
            }
            if (in_array("person_sys_log", $value)) {
                $onlyshowTableArr[] = $value;
            }
        } */
    }
    echo "<br>Search:<br>";
    return $onlyshowTableArr;
}


function SelectRecordRepairNoCreateDate($table)
{


    $sql = "desc  $table";
    $rs = $GLOBALS["conn"]->query($sql);

    echo "<br> show table <br>";


    // xdebug_var_dump($rs);
    $tableColumnarr = array();

    foreach ($rs as $key => $value) {
        // xdebug_var_dump($value["Field"]);
        /* if ($value["Field"] == "pk") {
            $tableColumnarr[] = "$table.pk";
        } elseif ($value["Field"] == "is_deleted") {
            $tableColumnarr[] = "$table.is_deleted";
        } else {
            $tableColumnarr[] = $value["Field"];
        } */

        $tableColumnarr[] = $table . "." . $value["Field"];
    }


    // xdebug_var_dump($tableColumnarr);
    $tableColumn = implode(",", $tableColumnarr);
    // xdebug_var_dump($tableColumn);
    $sql = "SELECT $tableColumn FROM  person , $table
    WHERE person.pk = person_fk
    AND person.createdate >= '2021-09-09 00:00:00'";
    // xdebug_var_dump($sql);

    $rs = $GLOBALS["conn"]->query($sql);

    echo "<br> SelectRecordFromRepair $table <br>";



    /* foreach ($rs as $key => $value) {
        xdebug_var_dump($value);
    } */

    return $rs;
}

function debug_loop($rs, $key = "")
{

    foreach ($rs as $key => $value) {
        xdebug_var_dump($value);
    }
}


function updatesqlfun($table)
{


    global $modifyfk;

    // xdebug_var_dump($modifyfk);
    // die();



    //create a lot of sql syntax
    // $i - count foreach
    $i = 0;
    foreach ($modifyfk as $key => $rs2) {


        updatesqlsyntax($table, $modifyfk, $i, "person");
        // loopUpdatesqlfkfunction($table, "person");
        $i++;
    }
}

// course module


include 'courseFunction.php';
