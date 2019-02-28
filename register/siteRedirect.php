


<!-- Redirecting Statement -->
<div style="text-align: center;">
	<img src="loader.gif" />
	<h3>Please don't refresh or reload the page.</h3>
	<h3>You are being redirected...</h3>
</div>



<?php

	if (isset($_POST) && count($_POST)>0 )
	{ 
		$txnStatus = $_POST['txnStatus'];
		$fullName = $_POST['fullName'];
		$regID = $_POST['regID'];
		$custEmail = $_POST['custEmail'];


		
		if($txnStatus == 'TXN_SUCCESS'){

			$to = $custEmail;

			$subject = "[SRIJAN 2019] Registration for $fullName";

			$message = "
				<html>
					<body>
						<p>Dear $fullName,</p>
						<div>Welcome to SRIJAN 2019!</div>
						<p><strong>Your registration was successful.</strong></p>
						<div>Please take note of the following-</div>
						<ul>
							<li>Registration ID - <strong>$regID</strong></li>
							<li>Dates for SRIJAN 2019 - <strong>8th March to 10th March</strong></li>
						</ul>
						<p>For any further queries, contact <a href='mailto:srijan@iitism.ac.in'>srijan@iitism.ac.in</a></p>
						<div>Regards,</div>
						<div>Vibhu Pandey</div>
						<div>Co-ordinator, SRIJAN 2019</div>
					</body>
				</html>
			";

			$headers[] = 'From: Srijan 2019 <no-reply@srijaniitism.org>';
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';

			mail($to, $subject, $message, implode("\r\n", $headers));

		}
	}

	// header("Location: http://localhost:8080/");
	header("Location: https://srijaniitism.org/");

?>
