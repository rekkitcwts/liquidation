<?php
App::import('Vendor','xtcpdf'); 
$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$tcpdf->SetAuthor($liquidation['Organisation']['name']);
$tcpdf->SetAutoPageBreak( false );
$tcpdf->setHeaderFont(array($textfont,'',40));
$tcpdf->xfootertext = 'Copyright © %d ' . $liquidation['Organisation']['name'] . '. All rights reserved.';

// add a page (required with recent versions of tcpdf)
$tcpdf->AddPage();

// Now you position and print your page content
$tcpdf->MultiCell(0, 0, 'Commonwealth of Australia', 0, 'C', false, 1);
$tcpdf->MultiCell(0, 0, $liquidation['Organisation']['name'], 0, 'C', false, 1);
$tcpdf->Cell(0,8,'','T',1,'C');
$tcpdf->MultiCell(0, 5, 'Liquidation Form No. _____', 0, 'R', false, 1);
$tcpdf->Cell(0,8,'','B',1,'C');
$tcpdf->MultiCell(0, 0, 'LIQUIDATION FORM', 0, 'C', false, 1);
$tcpdf->Cell(0,8,'','T',1,'C');
$tcpdf->MultiCell(0, 5, 'Name of recipient of cash advance: ' . $liquidation['Liquidation']['recipient'], 0, 'L', false, 1);
$tcpdf->MultiCell(0, 5, 'Position: ' . $liquidation['Liquidation']['position'], 0, 'L', false, 1);
$tcpdf->Cell(95.25,0,'Activity: ' . $liquidation['Liquidation']['activity'],0,0,'L',false);
$tcpdf->Cell(95.25,0,"Date Held: ______",0,0,'R',false);
$tcpdf->Ln();
$tcpdf->Cell(95.25,0,'Per Cash Voucher No.: ______',0,0,'L',false);
$tcpdf->Cell(95.25,0,"Date Filed: " . $liquidation['Liquidation']['created'],0,0,'R',false);
$tcpdf->Ln();
$tcpdf->Cell(0,8,'','B',1,'C');
$tcpdf->Cell(95.25,0,'Amount Received',0,0,'L',false);
$tcpdf->Cell(95.25,0,$liquidation['Liquidation']['amount_received'],0,0,'R',false);
$tcpdf->Ln();
$tcpdf->Ln();
$tcpdf->Cell(0,0,'Disbursements',0,0,'L',false);
$tcpdf->Ln();
// ...
// etc.
// see the TCPDF examples 
$header = array('Date', 'OR Number', 'Particulars', 'Amount');

$tcpdf->ColoredTable($header, $disbursements);

echo $tcpdf->Output('filename.pdf', 'I');

?>