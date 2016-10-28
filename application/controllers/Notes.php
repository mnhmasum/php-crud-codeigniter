<?php
/**
 * Created by PhpStorm.
 * User: masum
 * Date: 02/11/2015
 * Time: 13:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'email'));
    }

    //This function for checking is user is logged in or not
    function authentication_check()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('Login/login');
            return;
        }
    }

    public function create_note()
    {
        self::authentication_check();
        $this->load->view('notes/create_note');

    }

    public function save_note()
    {
        self::authentication_check();
        $autoload['helper'] = array('security');
        $this->load->helper('security');
        $this->form_validation->set_rules('title', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('notes/create_note');
            return;
        }
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $user_id = $this->session->userdata('userid');
        $this->load->database();
        $query = $this->db->query('INSERT INTO notes (title, description, user_id) VALUES("' . $title . '","' . $description . '", "' . $user_id . '")');
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">New note has been saved successfully!</div>');
        redirect('/view_notes');

    }

    public function update_note($id)
    {
        self::authentication_check();
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $this->load->database();
        $sql = "UPDATE `notes` SET `title` = '" . $title . "',
        `description` = '" . $description . "' WHERE `id` =" . $id;
        $query = $this->db->query($sql);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Note updated successfully!</div>');
        redirect('/view_notes');
    }

    public function edit_note($id)
    {
        self::authentication_check();
        $rows = array();
        $this->load->database();
        $sql = "SELECT * FROM notes where id =". $id;
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) $rows[] = $row;
        $data['notes'] = $rows;
        $this->load->view('notes/edit_note', $data);
    }

    public function view_notes()
    {
        self::authentication_check();
        $this->load->database();
        $query = $this->db->query('SELECT * FROM notes');
        $rows = array();
        foreach ($query->result() as $row) $rows[] = $row;
        $data['result'] = $rows;
        $this->load->view('notes/view_notes', $data);

    }

    public function delete_note($id)
    {
        self::authentication_check();
        $this->load->database();
        $sql = "Delete from notes where id=".$id;
        $query = $this->db->query($sql);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Note deleted successfully!</div>');
        redirect('/view_notes');

    }


}

?>
