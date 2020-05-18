<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Usuarios_model");
	}

	public function index()
	{

		if ($this->session->userdata("login")) {
			redirect(base_url() . "dashboard");
		} else {
			$this->load->view('admin/login');
		}
	}

	public function login()
	{
		$txtUserName = $this->input->post("txtUserName");
		$txtPassword = $this->input->post("txtPassword");

		$res = $this->Usuarios_model->login($txtUserName, sha1($txtPassword));

		if (!$res) {
			$this->session->set_flashdata("error", "El usuario y/o contraseña son incorectos");
			redirect(base_url());
		} else {
			$data = array(
				'id' => $res->idusuarios,
				'nombre' => $res->nombres,
				'rol_id' => $res->id_rol,
				'login' => TRUE
			);
			$this->session->set_userdata($data);
			redirect(base_url() . "dashboard");
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
