<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lupa_password extends CI_Controller{


   public function proses_lupa_password(){
        $this->form_validation->set_rules('password1', 'Password', 'trim|required');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]', array(
            'matches' => 'Password tidak sama, ulangi kembali !!!'
        ));

        if($this->form_validation->run() == false){
            $data['title']  = 'Lupa Password';

            $this->load->view('theme_admin/header', $data);
            $this->load->view('admin/lupa_password', $data);
            $this->load->view('theme_admin/footer', $data);
        }else{
            $data = array(
                'admin_id'  => $this->input->post('admin_id'),
                'password'  => md5($this->input->post('password2')),
            );

            // $id = array('admin_id' => $this->input->post('admin_id'));

            // $this->db->where($id);
            $this->db->update('admin', $data);

            $this->session->set_flashdata('msg', '<div class="modal fade" id="alert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Password berhasil diubah !!!
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ');

            redirect('admin/lupa_password');
        }

    }
}