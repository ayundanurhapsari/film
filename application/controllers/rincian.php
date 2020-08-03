<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rincian extends CI_Controller {
    function __construct(){
        parent::__construct();
                $this->load->model('m_rincian');
                $this->load->helper('url');
                $this->db->order_by('id_sewa', 'desc');
                

    }

    public function index() {

        if ( isset($_POST['add_to_cart']) ) {
            $data['film_id']        = $_POST['film_id'];
            $data['nama_penyewa']   = $_POST['nama_penyewa'];
            $data['nomor_rekening'] = $_POST['nomor_rekening'];
            $data['date_from']      = $_POST['date_from'];
            $data['date_to']        = $_POST['date_to'];
            $data['harga_sewa']     = $_POST['harga_sewa'];

            $data['availability'] = $this->m_rincian->check_if_available( $data['film_id'], $data['date_from'], $data['date_to'] );

            if ( !empty($data['availability']) ) {
                $data['error'] = 'Film yang ingin anda sewa tidak tersedia pada tanggal: <br />';

                foreach($data['availability'] as $value) {
                    $data['error'] .= " " . date('Y-m-d', strtotime($value['tgl_mulai'])) . " ";
                    $data['error'] .= " sampai  " . date('Y-m-d', strtotime($value['tgl_selesai'])) . "<br /><br> Silahkan pilih tanggal/hari lain...";
                }

            } else {
                $this->m_rincian->tambah_sesi($data);
                $this->m_rincian->update_total_sewa();
                $data['sewa_items'] = $this->m_rincian->get_sewa_items();
            }
        }

        $data['title']  = 'Sewa Film';

        $this->load->view('header', $data);
        $this->load->view('rincian_view', $data);
        $this->load->view('footer');
    }
    
    /*hapus dari rincian sewa*/
    public function remove($film_id) {
        $this->load->model('m_rincian');
        $this->m_rincian->hapus_sewa($film_id);
        $this->m_rincian->update_total_sewa();
        header('Location: ' . base_url() . 'rincian');
    }

    /*insert data ke dbs*/
    public function add() {
        $id_sewa = $this->input->post('id_sewa');
        $this->m_rincian->tambah_sewa();
    }

    /*kirim ke wa*/
    public function whatsapp() {
        $data = $this->db->get('sewa')->result();

        foreach ($data as $row) {
        redirect("https://api.whatsapp.com/send?phone=6282143638069&text=Hallo,%20nama%20saya%20".$row->nama_penyewa.",%20saya%20ingin%20menyewa%20%3A%0A1.%20Judul%20film%20%3A%20".$row->film_id."%0A2.%20Nomor%20rekening%20%3A%20".$row->nomor_rekening."%0A3.%20Periode%20sewa%20%3A%20".$row->tgl_mulai."%20sampai%20".$row->tgl_selesai."%0A4.%20Total%20harga%20%20sewa%20%3A%20Rp. ".$row->subtotal."%0A");
        }
    }
}