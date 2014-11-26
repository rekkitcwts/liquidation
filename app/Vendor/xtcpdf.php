 <?php
App::import('Vendor','tcpdf/tcpdf');

class XTCPDF extends TCPDF
{

    var $xheadertext  = '';
    var $xheadercolor = array(255,255,255);
    var $xfootertext  = 'Copyright %d Mozart Band. All rights reserved.';
    var $xfooterfont  = PDF_FONT_NAME_MAIN ;
    var $xfooterfontsize = 8 ;


    /**
    * Overwrites the default header
    * set the text in the view using
    *    $fpdf->xheadertext = 'YOUR ORGANIZATION';
    * set the fill color in the view using
    *    $fpdf->xheadercolor = array(0,0,100); (r, g, b)
    * set the font in the view using
    *    $fpdf->setHeaderFont(array('YourFont','',fontsize));
    */
    function Header()
    {

        list($r, $b, $g) = $this->xheadercolor;
        $this->setY(10); // shouldn't be needed due to page margin, but helas, otherwise it's at the page top
        $this->SetFillColor($r, $b, $g);
        $this->SetTextColor(0 , 0, 0);
        $this->Cell(0,20, '', 0,1,'C', 1);
        $this->Text(15,26,$this->xheadertext );
    }

    /**
    * Overwrites the default footer
    * set the text in the view using
    * $fpdf->xfootertext = 'Copyright Â© %d YOUR ORGANIZATION. All rights reserved.';
    */
    function Footer()
    {
        $year = date('Y');
        $footertext = sprintf($this->xfootertext, $year);
        $this->SetY(-20);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize);
        $this->Cell(0,8, $footertext,'T',1,'C');
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(30.625, 64.625, 64.625, 30.625);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row['Disbursement']['disbursement_date'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row['Disbursement']['or_number'], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, $row['Item']['item_name'], 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, $row['Disbursement']['amount'], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}
?> 