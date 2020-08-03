<?php defined('BASEPATH') OR exit('No direct script access allowed');

class m_rincian extends CI_Model {

    public function tambah_sesi($data) {
        $date_from = new DateTime($data['date_from']);
        $date_to   = new DateTime($data['date_to']);

        $days = $date_to->diff($date_from)->format("%a");
        $days = (int)$days;

        $total_cost = $data['harga_sewa'] * $days;

        $_SESSION['sewa_items'][ $data['film_id'] ] = array(
            'nama_penyewa'   => $data['nama_penyewa'],
            'nomor_rekening' => $data['nomor_rekening'],
            'date_from'      => $data['date_from'],
            'date_to'        => $data['date_to'],
            'total'          => $total_cost,
            'days'           => $days
        );
    }

    public function update_total_sewa() {
        $_SESSION['total_sewa'] = 0;

        foreach($_SESSION['sewa_items'] as $sewa_item) {
            $_SESSION['total_sewa'] += $sewa_item['total'];
        }
    }

    public function get_sewa_items() {
        $this->load->model('m_film');

        foreach($_SESSION['sewa_items'] as $film_id => $sewa_item) {
            $_SESSION['sewa_items'][$film_id]['movie_details'] = $this->m_film->get_movie($film_id);
        }
    }
    public function hapus_sewa($film_id) {
        unset($_SESSION['sewa_items'][$film_id]);
    }

    public function check_if_available($film_id, $date_from, $date_to) {
        $this->db->select('tgl_mulai, tgl_selesai');
        $this->db->from('sewa');

        $film_id = (int)$film_id;

        $from_date = 'film_id = "' . $film_id . '" and tgl_mulai BETWEEN "' . date('Y-m-d H:i:s', strtotime($date_from)) . '" and "' . date('Y-m-d H:i:s', strtotime($date_to)) . '"';
        $to_date   = 'film_id = "' . $film_id . '" and tgl_selesai BETWEEN "'   . date('Y-m-d H:i:s', strtotime($date_from)) . '" and "' . date('Y-m-d H:i:s', strtotime($date_to)) . '"';

        $this->db->where($from_date);
        $this->db->or_where($to_date);

        $query    = $this->db->get();

        if (!$query) {
            return "Error has occurred.";
        }

        $date_occupied = array();

        foreach( $query->result() as $row ) {
            $date_occupied[] = array(
                "tgl_mulai"     => $row->tgl_mulai,
                "tgl_selesai"   => $row->tgl_selesai
            );
        }

        return $date_occupied;
    }

    /**tambah data sewa*/
    public function tambah_sewa(){
        $data = array(
            'film_id'        => $this->input->post('film_id'),
            'nama_penyewa'   => $this->input->post('nama_penyewa'),
            'nomor_rekening' => $this->input->post('nomor_rekening'),
            'tgl_mulai'      => $this->input->post('tgl_mulai'), 
            'tgl_selesai'    => $this->input->post('tgl_selesai'),
            'subtotal'       => $this->input->post('subtotal')
    );
        $this->db->insert('sewa', $data);
        redirect('../film/rincian');
    }

}