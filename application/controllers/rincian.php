<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rincian extends CI_Controller {

    public function index() {
        $this->load->model('m_sewa');

        if ( isset($_POST['add_to_cart']) ) {
            $data['film_id'] = $_POST['film_id'];
            $data['date_from']  = $_POST['date_from'];
            $data['date_to']    = $_POST['date_to'];
            $data['harga_sewa'] = $_POST['harga_sewa'];

            $data['availability'] = $this->m_sewa->check_if_available( $data['film_id'], $data['date_from'], $data['date_to'] );

            if ( !empty($data['availability']) ) {
                $data['error'] = 'The vehicle you tried to add is not available for the selected days: <br />';

                foreach($data['availability'] as $value) {
                    $data['error'] .= " -  From: " . date('Y-m-d', strtotime($value['tgl_mulai'])) . "<br />";
                    $data['error'] .= " -  To: " . date('Y-m-d', strtotime($value['tgl_selesai'])) . "<br />";
                }

            } else {
                $this->m_sewa->tambah_sesi($data);
                $this->m_sewa->update_total_sewa();
                $data['sewa_items'] = $this->m_sewa->get_sewa_items();
            }
        }

        $data['title']  = 'Sewa';

        $this->load->view('header', $data);
        $this->load->view('sewa_view', $data);
        $this->load->view('footer');
    }
    
    public function remove($film_id) {
        $this->load->model('m_sewa');
        $this->m_sewa->hapus_sewa($film_id);
        $this->m_sewa->update_total_sewa();
        header('Location: ' . base_url() . 'rincian');
    }

    public function add() {
        $id_sewa = $this->input->post('id_sewa');
        $this->m_sewa->tambah_sewa();
    }
}