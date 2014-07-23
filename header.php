<?php
if ( isset($_GET['ln']) ){
    $str = ($_GET['ln']);
    $cssforactivli = <<<END
<script type="text/javascript">
    $(document).ready(function(){
            var has = $("#$str").hasClass('active');
            if( !has ){
                $("li.active").toggleClass('active');
                $("#$str").addClass('active');
            }
            LoadPage("$str");
    });
</script>
END;
}
$head = <<<END
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/cosmo/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="/js/script.js"></script>
        $cssforactivli
        <style>
            .form-signin {
                max-width: 400px;
                padding: 15px;
                margin: 0 auto;
            }
            .jumbotron {
                padding-top: 70px;
                padding-bottom: 70px;
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" onclick="LoadPage('main');MenuActive('main');">miniFreeLance(Demo)</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li id="main" class="active"><a href="#" onclick="LoadPage('main');MenuActive('main');">Главная</a></li>
            <li id="performers"><a href="#" onclick="LoadPage('lenta');MenuActive('lenta');">Лента заказов</a></li>
            <li id="customers"><a href="#" onclick="LoadPage('customers');MenuActive('customers');">Заказчикам</a></li>
          </ul>
        </div>
      </div>
    </div>
END;
echo $head;