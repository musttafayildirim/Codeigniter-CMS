<?php

class Portfolio_model extends CI_Model{

    public $tableName = "portfolios";
    public function __construct()
    {
        parent::__construct();
    }

    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function get_all($where = array(), $order = "id ASC", $limit = array("count" => 0, "start" => 0))
    {
        $this->db->where($where)->order_by($order);

        if (!empty($limit))
            $this->db->limit($limit["count"], $limit["start"]);

        return $this->db->get($this->tableName)->result();
    }

    public function add($data = array()){
        return $this->db->insert($this->tableName, $data);
    }

    public function update($where = array(), $data = array()){
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = array()){
        return $this->db->where($where)->delete($this->tableName);
    }
}
