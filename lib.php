<?php
//ini_set("display_errors",1);
session_start();
$sth = mysql_connect('mysql.hostinger.com.ua', 'u835029242_mfl', 'RfX7x86RLZ') or die(mysql_error());
function CheckUser($mail,$pass){
    mysql_select_db('u835029242_mfl') or die('Не удалось выбрать базу данных');
    $sql = "SELECT id,login,type FROM users WHERE mail='".$mail."' AND pass='".$pass."' LIMIT 1";
    $result = mysql_query($sql) or die(mysql_error());
    if( $result ){
        while ($res = mysql_fetch_array($result, MYSQL_ASSOC)) {
            foreach ($res as $key => $value) {
                $rows[$key] = $value;
            }
        }
        return $rows;
    }else{
        return FALSE;
    }
}
function RegUser($mail,$pass,$login,$type){
    mysql_select_db('u835029242_mfl') or die('Не удалось выбрать базу данных');
    $sql = "INSERT INTO users VALUES('','$login','$pass','$mail',$type)";
    $result = mysql_query($sql) or die(mysql_error());
    return $result;
}