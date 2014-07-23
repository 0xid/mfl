<?php
include './lib.php';
$rows = GetOrdersList();
if( isset($_SESSION['login']) ){
    if(isset($_SESSION['type']) && $_SESSION['type']==2){
        $btne = 1;
    }
    $login = $_SESSION['login'];
    $type = $_SESSION['type'] == 1 ? "(Заказчик)":"(Исполнитель)";
    $strOUT = <<<END
<div class="jumbotron">
        <div id="user">
            <h5 style="float:left;">Здравствуйте $login $type</h5>
            <h3 align="right"><a href="#" onclick="Logout();">Выйти</a></h3>
        </div>
END;
}else{
    $btn = '';
    $strOUT .= '<div class="jumbotron">';
}
if($rows){
    foreach ($rows as $value){
        if($btne==1){
            $btn = '<a class="btn btn-success btn-lg" role="button" style="float:right;margin-top:20px;" onclick="AcceptOrder(this,\'' . $_SESSION['id'] . '\',\'' . $value['id'] . '\');">Выполнить за ' . $value['price'] . '$</a>';
        }
        $strOUT .= '<div class="panel panel-default"><div class="panel-heading">';
        $strOUT .= '<h3 class="panel-title">' . $value['login'] . '</h3></div>';
        $strOUT .= '<div class="panel-body">' . $value['descr'] . $btn . '</div></div>';
    }
}
$strOUT .= '</div>';
print $strOUT;
