<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

    function save_data($data) {
        $this->db->insert('tb_user', $data);
        
    }

}

/* End of file Main_model.php */


?>