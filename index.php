<?php

/* 
 * 
 * 
 * 
 */

require_once("classes/class.pdo.php");
require_once("classes/class.database.php");

define("PDOdriver", "mysql");
define("PDOhost", "localhost");
define("PDOuser", "sybren");
define("PDOpass", "103225");
define("PDOdatabase", "mhl");


function getTestQuery()
    {
        $db = new FonDatabase();
        $result = $db->testquery();
        return $result;   
    }
    
function getTestQuery1()
    {
        $db = new FonDatabase();
        $result = $db->queryOpdracht1();
        return $result;   
    }
    
function getTestQuery2()
{
    $db = new FonDatabase();
    $result = $db->queryOpdracht2();
    return $result;   
}

function getTestQuery3()
{
    $db = new FonDatabase();
    $result = $db->queryOpdracht3();
    return $result;   
}
    
function getTestQuery4()
{
    $db = new FonDatabase();
    $result = $db->queryOpdracht4();
    return $result;
}
    
function getTestQuery5()
{
    $db = new FonDatabase();
    $result = $db->queryOpdracht5();
    return $result;
}

function getTestQuery6()
{
    $db = new FonDatabase();
    $result = $db->queryOpdracht6();
    return $result;
}

function gettest()
{
    $db = new FonDatabase();
    $result = $db->testqueryding();
    return $result;
}


foreach (getTestQuery6() as $array)
{
    echo $array[0]."<br>";
    echo $array[1]."<br>";
    echo $array[2]."<br><br>";
    

}
    
    
