<?php
/**
 * Created by PhpStorm.
 * User: masum
 * Date: 02/11/2015
 * Time: 13:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'email'));
    }

    function login()
    {
        $this->load->view('login/login_view');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('Login/login');
    }

    public function login_submit()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->database();
        $sql = "SELECT * FROM users where username='".$username."' and password='".md5($password)."'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rows = array();
            foreach ($query->result() as $row) $rows[] = $row;
            $data['result'] =  $rows;
            //$this->load->view('view_person', $data);
            $session_data = array(
                'userid' => $rows->id,
                'username' => $username,
                'password' => $password,
                'is_logged_in' => true,
            );
            $this->session->set_userdata($session_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Logged in success!</div>');
            //$this->load->view('create_team_view');
            redirect('Notes/view_notes');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Login failed!</div>');
            $this->load->view('Login/login_view');

        }

    }

}

?>
