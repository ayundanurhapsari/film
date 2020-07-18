<?php defined('BASEPATH') OR exit('No direct script access allowed');

class m_film extends CI_Model {

    public function get_film_dropdown() {
        $this->db->select('film_id, year, nama_film, genre, actor, deskripsi');
        $this->db->from('film');

        $query    = $this->db->get();
        $movies = array();

        foreach( $query->result() as $row ) {
            $movies[] = array(
                "id"         => $row->film_id,
                "year"       => $row->year,
                "nama_film"  => $row->nama_film
            );
        }

        return $movies;
    }

    public function get_movie($movie_id) {
        $this->db->select('*');
        $this->db->from('film');
        $this->db->where('film_id', $movie_id);

        $query = $this->db->get();

        if (!$query) {
            return false;
        }

        $row = $query->row();

        if (!isset($row)) {
            return false;
        }

        $movie = array(
            'year'               => $row->year,
            'nama_film'          => $row->nama_film,
            'genre'              => $row->genre,
            'actor'              => $row->actor,
            'deskripsi'          => $row->deskripsi,
            'harga_sewa'         => $row->harga_sewa
        );

        return $movie;
    }

    public function get_movies() {
        $this->db->select('*');
        $this->db->from('film');

        $query    = $this->db->get();
        $movies = array();

        foreach( $query->result() as $row ) {
            $movies[] = array(
                "id"          => $row->film_id,
                "year"        => $row->year,
                "nama_film"   => $row->nama_film,
                "genre"       => $row->genre,
                "harga_sewa"  => $row->harga_sewa,
                "description" => $row->deskripsi
            );
        }

        return $movies;
    }

    public function get_customer_rentals($user_id) {
        $this->db->select('sewa.tgl_mulai, sewa.tgl_selesai, film.year, film.nama_film, film.genre');
        $this->db->from('sewa');
        $this->db->where('sewa.reserved_by', $user_id);
        $this->db->join('film', 'sewa.film_id = film.film_id');

        $query    = $this->db->get();
        $vehicles = array();

        foreach( $query->result() as $row ) {
            $vehicles[] = array(
                "year"      => $row->year,
                "nama_film" => $row->nama_film,
                "genre"     => $row->genre,
                "date_from" => $row->tgl_mulai,
                "date_to"   => $row->tgl_selesai,
                "total_paid"=> $row->total_price_paid_with_taxes
            );
        }

        return $vehicles;
    }

    public function get_all_rentals() {
        $this->db->select('sewa.tgl_mulai, sewa.tgl_selesai, film.year, film.nama_film, film.genre');
        $this->db->from('sewa');
        $this->db->join('film', 'sewa.film_id = film.film_id');

        $query    = $this->db->get();
        $vehicles = array();

        foreach( $query->result() as $row ) {
            $vehicles[] = array(
                "year"       => $row->year,
                "nama_film"  => $row->nama_film,
                "genre"      => $row->genre,
                "date_from"  => $row->tgl_mulai,
                "date_to"    => $row->tgl_selesai,
                "total_paid" => $row->total_price_paid_with_taxes
            );
        }

        return $vehicles;
    }
}