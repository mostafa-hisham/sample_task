<?php

/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 03/02/2017
 * Time: 08:38 Õ
 */
class Employee extends Model
{
    protected $table_name = "employees";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     * returns all employee as array from database
     */
    public function employeesList()
    {
        return $this->db->select("SELECT id, name, image, address FROM {$this->table_name}");
    }

    /**
     * @param $id
     * @return mixed
     * select employee y id
     */
    public function getEmployeeByID($id)
    {
        return $this->db->fetch("SELECT * FROM {$this->table_name} WHERE id = {$id}");
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     * edit employee by id
     */
    public function editEmployee($id, $data)
    {
        $queryData = $data;
        $this->db->update($this->table_name, $queryData, "id = {$id}");
        return $this->db->fetch("SELECT * FROM {$this->table_name} WHERE id = {$id}");
    }

    /**
     * @param $data
     * create new employee with data
     */
    public function createEmployee($data)
    {
        $this->db->insert($this->table_name, $data);
    }
}