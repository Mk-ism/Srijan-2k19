<?php
	session_start();

	if(isset($_SESSION['login-token'])) {
		header("Location: index.php");
	}

    if(isset($_POST['login'])) {
        if(password_verify($_POST['pwd'], '$2y$10$a.qiaF7Lv.QFvQ5yrlR.hu3eomfNf1cAiP.qDtot/b44vW94ra7ui')) {
            $_SESSION['login-token'] = '$2y$10$a.qiaF7Lv.QFvQ5yrlR.hu3eomfNf1cAiP.qDtot/b44vW94ra7ui';
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Counter Login</title>

        <style type="text/css">
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            form {
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            input[type="password"] {
                min-width: 300px;
                padding: 10px;
                font-size: 20px;
                text-align: center;
            }
            input[type="submit"] {
                padding: 5px 10px;
                font-size: 18px;
                text-align: center;
            }
        </style>
	</head>
	<body>

        <form action="" method="post">
            <div>
                <input type="password" name="pwd" placeholder="Enter Password" required />
            </div>
            <p>
                <input type="submit" name="login" value="LOGIN" />
            </p>
        </form>

	</body>
</html>
