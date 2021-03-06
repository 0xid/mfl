<?php
include './lib.php';
if( !isset($_SESSION['login']) ){
$strOUT = <<<END
<div class="jumbotron">
    <form class="form-signin" role="form" id="sign">
    <span class="form-signin-heading" style="font-size:24px;">Пожалуйста войдите или <a href="#" onclick="GetRegistration();">зарегистрируйтесь</a></span>
    <input type="email" class="form-control" placeholder="Email address" required="" autofocus="" name="mail"></br>
    <input type="password" class="form-control" placeholder="Password" required="" name="pass"></br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="SignIn(this);">Войти</button>
  </form>
</div>
END;
}else{
    $login = $_SESSION['login'];
    $type = $_SESSION['type'] == 1 ? "(Заказчик)":"(Исполнитель)";
    $id = $_SESSION['id'];
    $info = GetAccountUser($_SESSION['type'],$id);
    if( $info && $_SESSION['type']==2 ){
        $in = 'Всего заработанно:' . $info['account'] . '</br> Выполнено всего ' . $info['COUNT(o.idperform)'] . ' заказов';
    }elseif( $info && $_SESSION['type']==1 ){
        $in = 'Всего заказов: ' . $info['COUNT(*)'];
    }
    $strOUT = <<<END
<div class="jumbotron">
        <div id="user">
            <h5 style="float:left;">Здравствуйте $login $type</h5>
            <h3 align="right"><a href="#" onclick="Logout();">Выйти</a></h3>
        </div>
            $in
</div>
END;
}
echo $strOUT;