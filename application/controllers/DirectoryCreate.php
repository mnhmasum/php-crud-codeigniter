<?php
/**
 * Created by PhpStorm.
 * User: masum
 * Date: 02/11/2015
 * Time: 13:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class DirectoryCreate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'email'));
    }

    public function index()
    {
        $this->load->database();
        $query = $this->db->query('SELECT * FROM gcm_users');
        $rows = array();
        foreach ($query->result() as $row) $rows[] = $row;
        //print json_encode($rows);

        $data['result'] = $rows;
        $this->load->view('view_person', $data);

    }

    function alpha_space_only($str)
    {
        if (!preg_match("/^[a-zA-Z ]+$/", $str)) {
            $this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function submitForm()
    {
        //echo "Test";
        //set validation rules
        $autoload['helper'] = array('security');
        $this->load->helper('security');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean|callback_alpha_space_only');
        $this->form_validation->set_rules('email', 'Emaid ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

        //run validation on form input
        if ($this->form_validation->run() == FALSE) {
            //validation fails
            $this->load->view('view_person');
        } else {
            //get the form data
            $name = $this->input->post('name');
            $from_email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            //set to_email id to which you want to receive mails
            $to_email = 'mnhmasum@gmail.com';

            //configure email settings
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.gmail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'mnhmasum@gmail.com';
            $config['smtp_pass'] = 'mypassword';
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n"; //use double quotes
            //$this->load->library('email', $config);
            $this->email->initialize($config);

            //send mail
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send()) {
                // mail sent
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
                redirect('Welcome/index');
            } else {
                //error
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
                redirect('Welcome/index');
            }
        }
    }

    function movieTrailer()
    {
        //$xml = simplexml_load_string("http://api.traileraddict.com/?featured=yes&count=10");
        header('Content-Type: application/json');
        $fileContents = file_get_contents("http://api.traileraddict.com/?featured=yes&count=20");
        $fileContents = str_replace('![CDATA[<', '', $fileContents);
        $fileContents = str_replace(']]>', '', $fileContents);
        //$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        //$fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_encode($simpleXml);

        echo $json;
        /*$json = json_encode($xml);
        $array = json_decode($json,TRUE);
        print $array;*/
    }

    function viewTable()
    {
        $this->load->view('view_table_point');
    }

    function login()
    {
        $this->load->view('login_view');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }

    public function loginSubmit()
    {
        echo $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->database();
        echo $sql = "SELECT * FROM users where username='".$username."' and password='".md5($password)."'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rows = array();
            foreach ($query->result() as $row) $rows[] = $row;
            $data['result'] =  $rows;
            $this->load->view('view_person', $data);
            $session_data = array(
                'username' => $username,
                'password' => $password,
                'is_logged_in' => true,
            );
            $this->session->set_userdata($session_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Logged in success!</div>');
            //$this->load->view('create_team_view');
            redirect('/create_team');
        } else {
            $this->session->set_flashdata('LogInMsg', '<div class="alert alert-success text-center"> Login failed!</div>');
            $this->load->view('login_view');

        }

    }

}

?>
