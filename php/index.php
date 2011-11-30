<?php
    /* 
	 * This page is a sample of your login page.
	 * In reality you will use the login of your own application instead of this.
	 */

	/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
    session_start();
    $error = null;
    if (isset($_POST['username']) && isset($_POST['password']))
    {
        $user = $_POST['username'];
        $password = $_POST['password'];
        
        if ($user == $password)
        {
            $_SESSION['user'] = $user;
            header('Location: app.php');
            return;
        }
        else
        {
            $error = 'Invalid username or password';
        }
    }
    else if (isset($_SESSION['user']))
    {
        header('Location: app.php');
        return;
    }
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Vendor Login Page</title>
    </head>
    <body>
        <h1>
            Vendor Login
        </h1>
        <p>
            This is a sample login page, it creates a session for a user.
		</p>
        <p>To authenticate a user, <b>make the username and password the same</b>.
        </p>
		<?php if ($error != null): ?>
            <div style="color:red">
                <?php print $error ?>
            </div>
        <?php endif ?>
        <form method="POST">
            <div>
                <input type="text" name="username" id="username" 
					placeholder="Username"/>
            </div>
            <div>
                <input type="password" autocomplete="off" name="password"
					id="password" placeholder="Password"/>
            </div>
            <div>
                <input type="submit" name="Login" value="Login"
                    id="login"/>
            </div>
        </form>
    </body>
</html>
