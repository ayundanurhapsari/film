<?php
Class Pdf_sewa extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->db->order_by('id_sewa', 'desc');
    }
    
    function index(){
        $pdf = new FPDF('P','mm','A4');
        $pdf->SetAutoPageBreak(false);
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Times','B',14);
        // mencetak string 
        $pdf->Cell(190,7,'NOTA SEWA',0,1,'C');     
        $pdf->SetFont('Times','',12);
        $pdf->Line(43,36,170,36);
        $pdf->SetLineWidth(0);
        $pdf->Line(43,37,170,37);
    //    $pdf->Cell(190,7,'__________________________________________________________________________________',0,1,'C');        
        // Memberikan space kebawah agar tidak terlalu rapat
        //$id_sewa = $_GET['id_sewa'];
        //$id_sewa = $this->db->query("SELECT * FROM sewa JOIN film ON film.id_film=sewa.id_film WHERE id_sewa='$id_sewa'");
        $sewa = $this->db->get();
        foreach ($sewa->result() as $row){
        $pdf->Cell(42,6,'Nama Penyewa                         :',0,0,'');
        $pdf->Cell(42,6,$row->nama_penyewa,0,1);
        $pdf->Cell(42,6,'Nomor Rekening     :',0,0,'');
        $pdf->Cell(20,6,$row->nomor_rekening,0,1);
        $pdf->Cell(42,6,'Periode Tanggal Sewa           :',0,0,'');
        $pdf->Cell(42,6,$row->tgl_mulai.', sampai '.$row->tgl_selesai,0,1);
        $pdf->Cell(42,6,'Total Harga Sewa     :',0,0,'');
        $pdf->Cell(20,6,$row->subtotal,0,1);        

        $pdf->Output();
    }
  }
}