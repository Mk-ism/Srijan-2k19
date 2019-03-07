<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	// echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<h1>Payment Successful</h1>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<h1>Payment Failure</h1>";
		if(isset($_POST['RESPMSG'])) echo "<h3>" . $_POST['RESPMSG'] . "</h3>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{
		foreach($_POST as $paramName => $paramValue) {
			echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}


}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

echo '<a href="index.php"><h4>Click here to go back to CounterPage</h4></a>';

?>



<!-- Redirecting Statement -->
<!--
<div style="text-align: center;">
	<img src="loader.gif" />
	<h3>Please don't refresh or reload the page.</h3>
	<h3>You are being redirected...</h3>
</div>
-->



<!--
<form method="post" action="siteRedirect.php" id="mailForm">
	<input type="email" id="email" name="email" hidden required />
	<input type="text" id="custID" name="custID" hidden required />
	<input type="text" id="regID" name="regID" hidden required />
	<input type="text" id="fullName" name="fullName" hidden required />
	<input type="text" id="events" name="events" hidden required />
	<input type="text" id="pronite" name="pronite" hidden required />
	<input type="text" id="accomodation" name="accomodation" hidden required />
	<input type="text" id="merchandise" name="merchandise" hidden required />
	<input type="text" name="txnAmount" value="<?php #echo $_POST['TXNAMOUNT']; ?>" hidden required />
	<input type="text" name="txnID" value="<?php #echo $_POST['TXNID']; ?>" hidden required />
	<input type="text" name="txnStatus" value="<?php #echo $_POST['STATUS']; ?>" hidden required />
</form>
-->



<!--
<script src="firebase.js"></script>
<script>
	// Initialize Firebase
	var config = {
		apiKey: "AIzaSyB5EGiiHuFcEWWzxsNRfxhh1vsVELWJ5ng",
		authDomain: "srijan-2019-84f75.firebaseapp.com",
		databaseURL: "https://srijan-2019-84f75.firebaseio.com",
		projectId: "srijan-2019-84f75",
		storageBucket: "srijan-2019-84f75.appspot.com",
		messagingSenderId: "1095745720648"
	};

	var testConfig = {
	    apiKey: "AIzaSyCsPYue1Pp_JJRopnvz2dkMGSgynosHyWg",
	    authDomain: "srijan-2019-testdb.firebaseapp.com",
	    databaseURL: "https://srijan-2019-testdb.firebaseio.com",
	    projectId: "srijan-2019-testdb",
	    storageBucket: "srijan-2019-testdb.appspot.com",
	    messagingSenderId: "827078747539"
	};

	firebase.initializeApp(config);
</script>
-->

<?php

	// $userID = str_replace('ORDS', '', $_POST['ORDERID']);

	// echo "<script>".
	// 	"firebase.database().ref('/register/" . $userID . "').update({
	// 		TXN_ID: '$_POST[TXNID]',
	// 		PAID_AMOUNT: '$_POST[TXNAMOUNT]',
	// 		STATUS: '$_POST[STATUS]',
	// 		RESP_CODE: '$_POST[RESPCODE]',
	// 		RESP_MSG: '$_POST[RESPMSG]'
	// 	});".
	// 	"firebase.database().ref('/register/" . $userID . "').once('value')
	// 		.then(function(snapshot){
	// 			document.getElementById('email').value = snapshot.val().email;
	// 			document.getElementById('custID').value = snapshot.val().CUST_ID;
	// 			document.getElementById('regID').value = snapshot.val().id;
	// 			document.getElementById('fullName').value = snapshot.val().firstName + ' ' + snapshot.val().lastName;
	// 			document.getElementById('events').value = snapshot.val().events;
	// 			document.getElementById('pronite').value = snapshot.val().pronite;
	// 			document.getElementById('accomodation').value = snapshot.val().accomodation;
	// 			document.getElementById('merchandise').value = snapshot.val().merchandise;
	// 			document.getElementById('mailForm').submit();
	// 		});".
	// "</script>";

?>
