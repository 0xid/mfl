function LoadPage(url){
    if( url === ''){url = 'main';}
    $.ajax({
        type: "POST",
        url: "/"+url+".php",
        dataType: "html",
        success: function(e){
            $('div#cont-main').html(e);
        }
    });
}
function Logout(){
    url = 'users';
    $.ajax({
        type: "POST",
        url: "/"+url+".php",
        data:"logout=1",
        dataType: "html",
        success: function(e){
            $('div#cont-main').html(e);
        }
    });
}
function SignIn(is){
    $(is).attr({disabled:'disabled'});
    mail = $('input[name=mail]').val();
    pass = $('input[name=pass]').val();
    $.ajax({
        type: "POST",
        url: "/users.php",
        data:"mail="+mail+"&pass="+pass,
        dataType: "html",
        success: function(e){
            $('div#cont-main').html(e);
            $(is).removeAttr('disabled');
        }
    });
}
function GetRegistration(){
    $.ajax({
        type: "POST",
        url: "/users.php",
        data:"type=get",
        dataType: "html",
        success: function(e){
            $('div#cont-main').html(e);
        }
    });
}
function SetRegistration(is){
    mail = $('input[name=mail2]').val();
    pass = $('input[name=pass2]').val();
    login = $('input[name=login]').val();
    type = $('input[name=type]').val();
    if( mail!=='' && pass!=='' && login!=='' && type!=='' ){
        $(is).attr({disabled:'disabled'});
        $.ajax({
            type: "POST",
            url: "/users.php",
            data:"mail2="+mail+"&pass2="+pass+"&login="+login+"&type="+type,
            dataType: "html",
            success: function(e){
                $('div#cont-main').html(e);
                $(is).removeAttr('disabled');
            }
        });
    }else{alert('Заполните все поля!');}
}
function MenuActive(id){
    $(".active").toggleClass('active');
    $("#"+id).addClass('active');
}