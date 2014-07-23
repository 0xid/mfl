<?php
include './lib.php';
if( !isset($_SESSION['login']) ){
    header("Location: /main.php");
}else{
    if($_SESSION['type'] == 1 && isset($_POST['price']) && isset($_POST['descr'])){
        $price = $_POST['price'];
        $dessc = $_POST['descr'];
        $rows = AddOrder($price,$dessc);
        if( $rows ){
            $strOUT = '<div class="jumbotron"><a href="#" onclick="LoadPage(\'main\');">Заказ добавлен.</a></div>';
            print $strOUT;
        }else{
            header("Location: /main.php");
        }
    }elseif($_SESSION['type'] == 2 && isset($_POST['idorder']) && isset($_POST['myid']) && $_POST['myid']==$_SESSION['id']){
        $idorder = $_POST['idorder'];
        $myid = $_POST['myid'];
        $rows = AcceptOrder($myid,$idorder);
        if( $rows ){
            $strOUT = '<div class="jumbotron"><a href="#" onclick="LoadPage(\'main\');">Заказ Выполнен.</a></div>';
            print $strOUT;
        }else{
            header("Location: /main.php");
        }
    }
    header("Location: /main.php");
}