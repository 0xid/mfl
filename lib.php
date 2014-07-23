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
    $sql = "INSERT INTO users VALUES('','$login','$pass','$mail',$type,'')";
    $result = mysql_query($sql) or die(mysql_error());
    return $result;
}
function GetOrdersList(){
    mysql_select_db('u835029242_mfl') or die('Не удалось выбрать базу данных');
    $sql = "SELECT o.id,o.idcustom,o.price,o.descr,u.login FROM `orders` o LEFT JOIN users u ON o.idcustom=u.id WHERE u.type=1 AND (o.idperform IS NULL OR o.idperform <= 0)";
    $result = mysql_query($sql) or die(mysql_error());
    if( $result ){
        while ($res = mysql_fetch_array($result, MYSQL_ASSOC)) {
            foreach ($res as $key => $value) {
                $rows[$res['id']][$key] = $value;
            }
        }
        return $rows;
    }else{
        return FALSE;
    }
}
function AddOrder($price,$dessc){
    $price = intval($price);
    $dessc = htmlspecialchars($dessc);
    $myid = intval($_SESSION['id']);
    mysql_select_db('u835029242_mfl') or die('Не удалось выбрать базу данных');
    $sql = "INSERT INTO orders VALUES('','$myid','','$price','$dessc')";
    $result = mysql_query($sql) or die(mysql_error());
    return $result;
}
function AcceptOrder($who,$idorder){
    $who = intval($who);
    $idorder = intval($idorder);
    mysql_select_db('u835029242_mfl') or die('Не удалось выбрать базу данных');
    $sql = "UPDATE orders SET idperform=$who WHERE id=$idorder";
    $result = mysql_query($sql) or die(mysql_error());
    if($result){
        $sql = "SELECT price FROM orders WHERE id=" . $idorder . " LIMIT 1";
        $result = mysql_query($sql) or die(mysql_error());
        if( $result ){
            while ($res = mysql_fetch_array($result, MYSQL_ASSOC)) {
                foreach ($res as $key => $value){
                    $pdf = $value * 0.25;
                    $sql = "UPDATE users SET account=account+($value-$pdf) WHERE id=$who";
                    $result = mysql_query($sql) or die(mysql_error());
                    $sql = "UPDATE users SET account=account+$pdf WHERE id=8";
                    $result = mysql_query($sql) or die(mysql_error());
                }
            }
        }
    }
    return $result;
}
function GetAccountUser($type,$who){
    mysql_select_db('u835029242_mfl') or die('Не удалось выбрать базу данных');
    if($type==2){
        $sql = "SELECT u.account, COUNT(o.idperform) FROM users u LEFT JOIN orders o ON u.id=o.idperform WHERE u.id=$who";
        $result = mysql_query($sql) or die(mysql_error());
        if( $result ){
            while ($res = mysql_fetch_array($result, MYSQL_ASSOC)) {
                foreach ($res as $key => $value) {
                    $rows[$key] = $value;
                }
            }
            return $rows;
        }else{return FALSE;}
    }elseif($type==1){
        $sql = "SELECT COUNT(*) FROM orders WHERE idcustom=$who";
        $result = mysql_query($sql) or die(mysql_error());
        if( $result ){
            while ($res = mysql_fetch_array($result, MYSQL_ASSOC)) {
                foreach ($res as $key => $value) {
                    $rows[$key] = $value;
                }
            }
            return $rows;
        }else{return FALSE;}
    }
}