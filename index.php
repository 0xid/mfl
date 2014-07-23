<?php
require './header.php';
$strOUT = <<<END
<div class="container">
    <div class="jumbotron">
        <h1>Hello, world!</h1>
        <form id="login-register" method="post" action="user.php">
            <input type="text" placeholder="your@email.com" name="email" autofocus />
            <p>Enter your email address above and we will send <br />you a login link.</p>
            <button type="submit">Login / Register</button>
        </form>
    </div>
</div>
END;
echo $strOUT;
require './footer.php';