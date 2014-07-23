<?php
include './lib.php';
if( isset($_POST['mail']) && isset($_POST['pass']) ){
    $mail = htmlspecialchars(trim($_POST['mail']));
    $pass = md5($_POST['pass']);
    $rows = CheckUser($mail,$pass);
    if( $rows ){
        session_start();
        $_SESSION['login'] = $rows['login'];
        $_SESSION['id'] = $rows['id'];
        $_SESSION['type'] = $rows['type'];
        header("Location: /main.php");
    }else{
        $strOUT = <<<END
<div class="jumbotron">
    <form class="form-signin" role="form" id="sign">
    <span class="form-signin-heading alert-danger" role="alert" style="font-size:24px;">Не верный логин или пароль!</span>
    <input type="email" class="form-control" placeholder="Email address" required="" autofocus="" name="mail"></br>
    <input type="password" class="form-control" placeholder="Password" required="" name="pass"></br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="SignIn(this);">Войти</button>
  </form>
</div>
END;
        print $strOUT;
    }
}elseif( isset($_POST['logout']) && $_POST['logout'] == 1 ){
    unset($_SESSION["login"]);
    unset($_SESSION["id"]);
    unset($_SESSION["type"]);
    session_destroy();
    header("Location: /main.php");
}elseif( isset($_POST['type']) && $_POST['type'] == 'get' ){
    $strOUT = <<<END
<div class="jumbotron">
    <form class="form-signin" role="form" id="sign">
    <span class="form-signin-heading" role="alert" style="font-size:24px;">Заполните поля:</span>
    <input type="text" class="form-control" placeholder="You Login" required="" autofocus="" name="login"></br>
    <input type="email" class="form-control" placeholder="Email address" required="" autofocus="" name="mail2"></br>
    <input type="password" class="form-control" placeholder="Password" required="" name="pass2"></br>
    <span>Кем вы являетесь?</span></br>
    <span>Заказчик<input type="radio" class="type form-control"" name="type" value="2" checked="checked"></span>
    <span>Исполнитель<input type="radio" class="type form-control"" name="type" value="1"></span></br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="SetRegistration(this);">Зарегистироваться</button>
  </form>
</div>
END;
        print $strOUT;
}elseif( isset($_POST['login']) && isset($_POST['mail2']) && isset($_POST['pass2']) && isset($_POST['type']) ){
    $mail2 = htmlspecialchars(trim($_POST['mail2']));
    $pass2 = md5($_POST['pass2']);
    $login = htmlspecialchars(trim($_POST['login']));
    $type = intval($_POST['type']);
    $rows = RegUser($mail2,$pass2,$login,$type);
    if( $rows ){
        $strOUT = '<div class="jumbotron"><a href="#" onclick="LoadPage(\'main\');">Теперь можете войти под своим аккаунтом.</a></div>';
        print $strOUT;
    }else{
        $strOUT = <<<END
<div class="jumbotron">
    <form class="form-signin" role="form" id="sign">
    <span class="form-signin-heading alert-danger" role="alert" style="font-size:24px;">Не все поля заполнены:</span>
    <input type="text" class="form-control" placeholder="You Login" required="" autofocus="" name="login"></br>
    <input type="email" class="form-control" placeholder="Email address" required="" autofocus="" name="mail2"></br>
    <input type="password" class="form-control" placeholder="Password" required="" name="pass2"></br>
    <span>Кем вы являетесь?</span></br>
    <span>Заказчик<input type="radio" class="type form-control"" name="type" value="2" checked="checked"></span>
    <span>Исполнитель<input type="radio" class="type form-control"" name="type" value="1"></span></br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="SetRegistration(this);">Зарегистироваться</button>
  </form>
</div>
END;
        print $strOUT;
    }
}else{
    header("Location: /main.php");
}