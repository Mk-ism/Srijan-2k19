<?php
	session_start();

	if(!isset($_SESSION['login-token'])){
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Proceed to Pay</title>

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
            input[type="text"] {
                min-width: 300px;
                padding: 10px;
                font-size: 20px;
                text-align: center;
            }
            button {
                padding: 5px 10px;
                font-size: 18px;
                text-align: center;
            }
        </style>
	</head>
	<body>

        <form action="pgRedirect.php" method="post">
            <div>
                <input type="text" list="payment-values" name="TXN_AMOUNT" placeholder="Enter Transaction Amount" required />
                <datalist id="payment-values">
                    <option value="1450">
                    <option value="850">
                    <option value="1250">
                    <option value="950">
                    <option value="1100">
                    <option value="1050">
                </datalist>
            </div>
            <p>
                <button>Proceed to Pay</button>
            </p>
        </form>

	</body>
</html>
