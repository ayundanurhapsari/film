<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sewa_film extends CI_Controller {

    public function index() {
        $data['title'] = 'Pilih Film';

        $this->load->model('m_film');
        $data['movies']  = $this->m_film->get_movies();

        $this->load->view('header', $data);
        $this->load->view('film_disewakan_view', $data);
        $this->load->view('footer');
    }

    public function process_search($movie_id = '') {
        $this->index();

        $data = array();

        if ( isset($_POST['search_for_vehicles_submit']) ) {
            $data['film_id']    = $_POST['movie'];
            $data['date_from']  = $_POST['date_from'];
            $data['date_to']    = $_POST['date_to'];
        } elseif ( $movie_id != '' ) {
            $data['film_id']    = $movie_id;
            $data['date_from']  = date('Y-m-d');
            $data['date_to']    = date('Y-m-d', strtotime("+3 days"));
        } else {
            header('Location: ' . base_url());
            return;
        }

        $this->load->model('m_film');
        $data['movies']       = $this->m_film->get_movie($data['film_id']);
        $data['image_folder'] = base_url() . "assets/images/" .
            strtolower($data['movies']['year']) . "_" .
            str_replace(" ", "_", strtolower($data['movies']['nama_film'])) . "_" .
            strtolower($data['movies']['genre']);

        $this->load->view('sewa_film_view', $data);
    }
}