<?php

class Pdf  
{
    public $workbook;
    public $papersize = 'a4';
    public $orientation = 'portrait';
    public $outputname = 'pdf_export.pdf';
    
    function __construct()
    {
        require_once('dompdf/dompdf_config.inc.php');
    }

    function set_paper($size, $orientation)
    {
        $this->papersize = $size;
        $this->orientation = $orientation;
    }

    function set_stream_name($name)
    {
        $this->outputname = $name;
    }
    
    function make($doc,$filename = null){
        $dompdf = new DOMPDF();
        $dompdf->load_html($doc);
        $dompdf->set_paper($this->papersize, $this->orientation );

        $dompdf->render();

        $dompdf->stream($this->outputname, array("Attachment" => false));

        exit(0);

    }

}

?>