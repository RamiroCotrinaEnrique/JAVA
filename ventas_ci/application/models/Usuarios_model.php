<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	
	public function login($txtUserName, $txtPassword)
	{
		$this->db->where("username",$txtUserName);
        $this->db->where("password",$txtPassword);
        
        $result = $this->db->get("usuarios");

        if ($result->num_rows() > 0) {
            return $result->row();
        }
        else {
            return false;
        }
	}
}
