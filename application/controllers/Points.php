<?php
/**
 * Created by PhpStorm.
 * User: masum
 * Date: 02/11/2015
 * Time: 13:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Points extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'email'));
    }
    function sessionControl()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/login');
            return;
        }
    }
    public function index()
    {
        self::sessionControl();
        $this->load->database();
        $query = $this->db->query('SELECT * FROM gcm_users');
        $rows = array();
        foreach ($query->result() as $row) $rows[] = $row;
        //print json_encode($rows);
        $data['result'] = $rows;
        $this->load->view('view_person', $data);
    }
    function viewTable()
    {
        self::sessionControl();
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
        $this->load->view('view_table_point');
    }
    function createTournament()
    {
        self::sessionControl();
        $this->load->database();
        $query = $this->db->query('SELECT * FROM tournaments');
        $rows = array();
        foreach ($query->result() as $row) $rows[] = $row;
        $data['tournaments'] = $rows;
        $this->load->view('create_tournament_view', $data);
    }
    function updateTournament()
    {
        self::sessionControl();
        $id = $this->input->get('id');
        $this->load->database();
        $query = $this->db->query('SELECT * FROM tournaments where tournament_id=' . $id);
        $rows = array();
        foreach ($query->result() as $row) $rows[] = $row;
        $data['tournaments'] = $rows;
        $this->load->view('update_tournament_view', $data);
    }
    function updateSubmitTournament()
    {
        self::sessionControl();
        $rows = array();
        $id = $this->input->post('id');
        $tournamentName = $this->input->post('name');
        $status = $this->input->post('status');
        $this->load->database();
        $sql = "UPDATE `tournaments` SET `tournament_name` = '" . $tournamentName . "',
        `status` = " . $status . " WHERE `tournament_id` =" . $id;
        $query = $this->db->query($sql);
        $sql = "UPDATE `tournaments` SET `status` = " . 0 . " WHERE `tournament_id` !=" . $id;
        $query = $this->db->query($sql);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Tournaments updated successfully!</div>');
        //self::createPoints();
        redirect('/create_tournament');
        //self::createTournament();
    }
    function createTeam()
    {
        //self::sessionControl();
        $this->load->database();
        $query = $this->db->query('SELECT * FROM teams');
        $rows = array();
        foreach ($query->result() as $row) $rows[] = $row;
        $data['teams'] = $rows;
        $this->load->view('create_team_view', $data);
    }
    function createPoints()
    {
        self::sessionControl();
        $this->load->database();
        $rows = array();
        $query = $this->db->query('SELECT * FROM tournaments');
        foreach ($query->result() as $row) $rows[] = $row;
        //print json_encode($rows);
        $data['result'] = $rows;
        $rows = array();
        $query = $this->db->query('SELECT * FROM teams');
        foreach ($query->result() as $row) $rows[] = $row;
        $data['teams'] = $rows;
        $rows = array();
        $query = $this->db->query('SELECT tournaments.tournament_name, points.point_id, teams.team_name,
        points.no_of_played, points.win, points.lost, points.points FROM points, teams, tournaments
        where points.team_id = teams.team_id and points.tournament_id = tournaments.tournament_id and tournaments.status = 1');
        foreach ($query->result() as $row) $rows[] = $row;
        $data['points'] = $rows;
        $this->load->view('create_points_view', $data);
    }
    function submitTeam()
    {
        self::sessionControl();
        $autoload['helper'] = array('security');
        $this->load->helper('security');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('create_team_view');
            return;
        }
        $name = $this->input->post('name');
        $this->load->database();
        $query = $this->db->query('INSERT INTO teams (team_name) VALUES("' . $name . '")');
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">' . $name . ' is added successfully!</div>');
        $this->load->view('create_team_view');
    }

    function submitTournament()
    {
        self::sessionControl();
        $autoload['helper'] = array('security');
        $this->load->helper('security');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('create_team_view');
            return;
        }
        $name = $this->input->post('name');
        $this->load->database();
        $query = $this->db->query('INSERT INTO tournaments (tournament_name) VALUES("' . $name . '")');
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">' . $name . ' tournament is added successfully!</div>');
        $this->load->view('create_team_view');
    }
    function submitPoints()
    {
        self::sessionControl();
        $autoload['helper'] = array('security');
        $this->load->helper('security');
        $this->form_validation->set_rules('match_played', 'MatchPlayed', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            //$this->load->view('create_points_view');
            self::createPoints();
            return;
        }
        $tournament_name = $this->input->post('tournament_name');
        $team_name = $this->input->post('team_name');
        //exit;
        $match_played = $this->input->post('match_played');
        $win = $this->input->post('win');
        $lost = $this->input->post('lost');
        $points = $this->input->post('points');
        $this->load->database();
        $sql = 'SELECT * FROM points where `team_id`="' . $team_name . '" and `tournament_id`="' . $tournament_name . '"';
        $query = $this->db->query($sql);
        //exit;
        //echo $query->num_rows();
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Points already assigned</div>');
            self::createPoints();
            return;
        }
        echo $sql = 'INSERT INTO points (`team_id`,`tournament_id`,`no_of_played`,`win`,`lost`,`points`)
        VALUES("' . $team_name . '", "' . $tournament_name . '", "' . $match_played . '", "' . $win . '", "' . $lost . '", "' . $points . '")';
        $query = $this->db->query($sql);
        //exit;
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Points is added successfully!</div>');
        //self::createPoints();
        //$this->load->view('create_points_view');
        redirect('/Point/createPoints');
    }
    public function updatePoints()
    {
        self::sessionControl();
        $rows = array();
        $id = $this->input->get('id');
        $this->load->database();
        $sql = "SELECT points.point_id, tournaments.tournament_name, teams.team_name, points.no_of_played, points.win, points.lost, points.points FROM points, teams, tournaments
        where points.team_id=teams.team_id and tournaments.status=1 and points.point_id=" . $id;
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) $rows[] = $row;
        $data['points'] = $rows;
        $this->load->view('update_points_view', $data);
    }

    public function updatePointsId($id)
    {
        self::sessionControl();
        $rows = array();
        //$id = $this->input->get('id');
        $this->load->database();
        $sql = "SELECT points.point_id, tournaments.tournament_name, teams.team_name, points.no_of_played, points.win, points.lost, points.points FROM points, teams, tournaments
        where points.team_id=teams.team_id and tournaments.status=1 and points.point_id=" . $id;
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) $rows[] = $row;
        $data['points'] = $rows;
        $this->load->view('update_points_view', $data);
    }

    public function updatePointsSubmit()
    {
        self::sessionControl();
        $rows = array();
        $id = $this->input->post('id');
        $match_played = $this->input->post('match_played');
        $win = $this->input->post('win');
        $lost = $this->input->post('lost');
        $points = $this->input->post('points');
        $this->load->database();
        $sql = "UPDATE `gcm`.`points` SET `no_of_played` = " . $match_played . ",
        `win` = " . $win . ", `lost` = " . $lost . ", `points` = " . $points . " WHERE `points`.`point_id` =" . $id;
        $query = $this->db->query($sql);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Points updated successfully!</div>');
        //self::createPoints();
        redirect('/Point/createPoints');
    }

    public function deletePoints()
    {
        self::sessionControl();
        $rows = array();
        $id = $this->input->get('id');
        $this->load->database();
        $sql = "Delete from points where point_id=" . $id;
        $query = $this->db->query($sql);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Points deleted successfully!</div>');
        self::createPoints();
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

}
?>