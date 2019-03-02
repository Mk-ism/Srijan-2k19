<?php

error_reporting(0);

require_once('TCPDF/tcpdf.php');

if (isset($_POST) && count($_POST)>0 ) {

	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

	$pdf->SetDefaultMonospacedFont('courier');

	$pdf->SetMargins(10, 10, 10);

	$pdf->SetAutoPageBreak(true, 10);

	$pdf->setImageScale(1.25);

	$pdf->SetFont('courier', '', 13);

	$pdf->AddPage();



	$pageWidth = $pdf->getPageWidth();
	$pageHeight = $pdf->getPageHeight();

	$pdf->SetLineStyle( array( 'width' => 0.3, 'color' => array(0,0,0)));
	$pdf->Line(5, 5, $pageWidth-5, 5);
	$pdf->Line($pageWidth-5, 5, $pageWidth-5, $pageHeight-5);
	$pdf->Line(5, $pageHeight-5, $pageWidth-5, $pageHeight-5);
	$pdf->Line(5, 5, 5, $pageHeight-5);



	$left_column = '<img style="width: 200px;" src="/register/html2pdf/images/srijanlogo.png" />';
	$right_column = '<img style="width: 100px;" src="/register/html2pdf/images/ismlogo.png" />';

	$pdf->SetFillColor(68, 68, 68);

	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	$pdf->writeHTMLCell(75, '', '', '', $left_column, 0, 0, 1, true, 'C', true);
	$pdf->writeHTMLCell('', '', '', '', $right_column, 0, 1, 0, true, 'R', true);
	$pdf->ln(20);


	if($_POST['txnID'] != '') $html = '<div style="text-align: right; font-size: 11px;">TXN_ID: '.$_POST['txnID'].'</div>';

	$html .= '<h1 style="text-align: center; font-size: 36px;">Welcome to SRIJAN 2019</h1>';

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')

	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->ln(10);



	$html = '
		<h3 style="font-size: 22px;">Here are your registration details : </h3>
		<div><b>Name</b> : '.$_POST['fullName'].'</div>
		<div><b>Registration ID</b> : '.$_POST['regID'].'</div>
		<div><b>CUST_ID</b> : '.$_POST['custID'].'</div>
		<div><b>Transaction Amount</b> : '.$_POST['txnAmount'];

	if($_POST['txnStatus'] == 'TXN_SUCCESS') $html .= ' (Paid)</div>';
	else $html .= ' (<b>Due</b>)</div>';

	if($_POST['events'] != '') $html .= '<div><b>Events (registered for)</b> : '.str_replace(',', ', ', $_POST['events']).'</div>';

	$pdf->writeHTMLCell('', '', '', '', $html, 0, 1, 0, true, 'C', true);



	$y = $pdf->getY();

	if($_POST['events'] != '') $content1 = '<img style="width: 100px;" src="/register/html2pdf/images/e_large.jpg" />';
	else $content1 = '';
	if($_POST['pronite'] == 'true') $content2 = '<img style="width: 100px;" src="/register/html2pdf/images/p_large.jpg" />';
	else $content2 = '';
	if($_POST['accomodation'] == 'true') $content3 = '<img style="width: 100px;" src="/register/html2pdf/images/a_large.jpg" />';
	else $content3 = '';
	if($_POST['merchandise'] == 'true') $content4 = '<img style="width: 100px;" src="/register/html2pdf/images/m_large.jpg" />';
	else $content4 = '';

	$pdf->writeHTMLCell(($pageWidth-20)/4, '', '', $y+20, $content1, 0, 0, 0, true, 'C', true);
	$pdf->writeHTMLCell(($pageWidth-20)/4, '', '', '', $content2, 0, 0, 0, true, 'C', true);
	$pdf->writeHTMLCell(($pageWidth-20)/4, '', '', '', $content3, 0, 0, 0, true, 'C', true);
	$pdf->writeHTMLCell(($pageWidth-20)/4, '', '', '', $content4, 0, 1, 0, true, 'C', true);



	$footer = '
		<b>Note:</b> Please bring a printout of this receipt at the registration desk to get an ID card
	';

	$pdf->SetFont('courier', '', 10);
	$pdf->writeHTMLCell('', '', '', -15, $footer, 0, 0, 0, true, 'C', true);



	$pdf->lastPage();



	if (file_exists(dirname(__FILE__).'/RegistrationDetails.pdf')) unlink(dirname(__FILE__).'/RegistrationDetails.pdf');
	$pdf->Output(dirname(__FILE__).'/RegistrationDetails.pdf', 'F');

}

?>
