<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model', 'main');
        $this->load->library('form_validation');
        $this->load->model('Wilayah_model');
        
    }
    

    public function index()
    {
        $data = array(
            'title' => 'Form',
            'action' => 'process'
        );

        $this->load->view('form', $data);
        
    }

    // public function process()
    // {

    //     $this->_rules('create');
    //     $data = array(
    //         'nama' => $this->input->post('nama'),
    //         'nik' => $this->input->post('nik'),
    //         'tanggal_lahir' => $this->input->post('tanggal_lahir'),
    //         'tempat_lahir' => $this->input->post('tempat_lahir'),
    //         'jenis_kelamin' => $this->input->post('jenis_kelamin'),
    //         'email' => $this->input->post('email'),
    //         'password' => password_hash($this->input->post('password',TRUE),PASSWORD_DEFAULT),
    //     );

    //     $this->main->save_data($data);
    //     redirect('form','refresh');
        
    // }

    public function process()
    {
        $this->_rules('create');
        
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke form dengan pesan error
            $data = array(
                'title' => 'Form',
                'action' => 'process'
            );
            $this->load->view('form', $data);
        } else {
            // Jika validasi berhasil, lanjutkan proses
            $data = array(
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'email' => $this->input->post('email'),
                'provinsi' => $this->input->post('provinsi'),
                'kabupaten' => $this->input->post('kabupaten'),
                'kecamatan' => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
            );

            $this->main->save_data($data);
            redirect('form', 'refresh');
        }
    }


    public function get_provinsi()
    {
        $data = $this->Wilayah_model->get_all_provinsi();
        echo json_encode($data);
    }

    // Ambil kabupaten berdasarkan id_provinsi
    public function get_kabupaten($id_provinsi)
    {
        $data = $this->Wilayah_model->get_kabupaten_by_provinsi($id_provinsi);
        echo json_encode($data);
    }

    // Ambil kecamatan berdasarkan id_kabupaten
    public function get_kecamatan($id_kabupaten)
    {
        $data = $this->Wilayah_model->get_kecamatan_by_kabupaten($id_kabupaten);
        echo json_encode($data);
    }

    // Ambil desa berdasarkan id_kecamatan
    public function get_desa($id_kecamatan)
    {
        $data = $this->Wilayah_model->get_desa_by_kecamatan($id_kecamatan);
        echo json_encode($data);
    }

    // function _rules($rules) {
    //     switch ($rules) {
    //         case 'create':
    //             $this->form_validation->set_rules('nik', 'Nik', 'int|trim|required|min_length[16]|max_length[20]',array(
    //                 'required' => '%s wajib di isi !',
    //                 'min_length' => '%s terlalu pendek !',
    //                 'max_length' => '%s terlalu panjang !',
    //             ));
    //             $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', array(
    //                 'required' => '%s wajib diisi!',
    //                 'min_length' => '%s minimal 6 karakter!'
    //             ));
                
    //             $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required|matches[password]', array(
    //                 'required' => '%s wajib diisi!',
    //                 'matches' => '%s tidak cocok dengan password!'
    //             ));
                
     
    //             break;

          
    //             default:
    //             # code...
    //             break;
    //     }
        
    // }

    private function _rules($type = 'create')
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', array(
            'required' => '%s wajib diisi!'
        ));
        $this->form_validation->set_rules('nik', 'Nik', 'min_length[16]|max_length[20]|required', array(
            'required' => '%s wajib diisi!'
        ));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array(
            'required' => '%s wajib diisi!',
            'valid_email' => '%s harus berformat email yang valid!'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', array(
            'required' => '%s wajib diisi!',
            'min_length' => '%s minimal 6 karakter!'
        ));
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password]', array(
            'required' => '%s wajib diisi!',
            'matches' => '%s tidak cocok dengan password!'
        ));
    }

}

/* End of file Main_controller.php */

    
?>