<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index() {
		$data['title'] = 'Sewa Film - Madiun';

		$this->load->model('m_film');
		$data['movies'] = $this->m_film->get_film_dropdown();

		$this->load->view('header', $data);
		$this->load->view('main_view', $data);
		$this->load->view('footer');
	}
}