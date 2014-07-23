<?php
include './lib.php';
if( !isset($_SESSION['login'])){
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
    $strOUT = <<<END
<div class="jumbotron">
        <div id="user">
            <h5 style="float:left;">Здравствуйте $login $type</h5>
            <h3 align="right"><a href="#" onclick="Logout();">Выйти</a></h3>
        </div>
END;
    if(isset($_SESSION['type']) && $_SESSION['type'] == 2 ){
        $strOUT .= '<span class="form-signin-heading alert-danger" role="alert" style="font-size:24px;">Вы не являетесь заказчиком!  Для Вас раздел закрыт.</span>';
    }
    
    $strOUT .= <<<END
    <form class="form-add" role="form" id="add">
    <span class="form-signin-heading" style="font-size:24px;">Добавление заказа:</span>
    <input type="price" class="form-control" placeholder="Price (Integer)" required="" autofocus="" name="price"></br>
    <textarea class="form-control" placeholder="Order:" required="" name="order" id="descr"></textarea></br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="AddOrder(this);">Оставить заказ</button>
  </form>
END;
    $strOUT .= '</div>';
}
echo $strOUT;