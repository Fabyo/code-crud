<?php

class User extends CI_Model 
{ 
    function __construct() 
    {
        parent::__construct();
       
        $this->load->database();
    }
 
    function cadastrar($data) 
    {
        return $this->db->insert('users', $data);
    }

	function listar() 
	{
    	$query = $this->db->get('users');
    	return $query->result();
	}

	function editar($id) 
	{
    	$this->db->where('id', $id);
    	return $this->db->get('users')->result();
	}

	function alterar($data) 
	{
	    $this->db->where('id', $data['id']);
	    $this->db->set($data);
	    return $this->db->update('users');
	}	

	function deletar($id) 
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('users');
	}

    public function count() 
    {
        return $this->db->count_all('users');
    }

    public function pagin($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }	
}