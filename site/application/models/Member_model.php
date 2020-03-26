<?php

class Member_model extends CI_Model{

    public $tableName = "members";
    public function __construct()
    {
        parent::__construct();
    }

    public function add($data = array()){
        return $this->db->insert($this->tableName, $data);
    }

}
