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
$tcpdf->MultiCell(0, 5, 'Liquidation Form No. _____', 0, 'R', false, 1);
$tcpdf->MultiCell(0, 5, 'Name of recipient: ' . $liquidation['Liquidation']['recipient'], 0, 'L', false, 1);
$tcpdf->MultiCell(0, 5, 'Position: ' . $liquidation['Liquidation']['position'], 0, 'L', false, 1);
// ...
// etc.
// see the TCPDF examples 

echo $tcpdf->Output('filename.pdf', 'D');

?>