<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah_model extends CI_Model
{
    public function get_all_provinsi()
    {
        return $this->db->get('reg_provinces')->result();
    }

    public function get_kabupaten_by_provinsi($id_provinsi)
    {
        return $this->db->get_where('reg_regencies', ['province_id' => $id_provinsi])->result();
    }

    public function get_kecamatan_by_kabupaten($id_kabupaten)
    {
        return $this->db->get_where('reg_districts', ['regency_id' => $id_kabupaten])->result();
    }

    public function get_desa_by_kecamatan($id_kecamatan)
    {
        return $this->db->get_where('reg_villages', ['district_id' => $id_kecamatan])->result();
    }
}
