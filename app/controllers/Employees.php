<?php

/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 03/02/2017
 * Time: 07:28 Õ
 */
class Employees extends Controller
{
    /*
     * renders all employees
     */
    public function index()
    {
        $employees = $this->model('Employee')->employeesList();
        $this->view('employees/index', ['employees' => $employees]);
    }

    /*
     * renders create new employee page
     */
    public function createEmployee()
    {
        $this->view('employees/create');
    }

    /*
     * creates new employee
     */
    public function createEmployeeSave()
    {
        $data = array();
        if (isset($_FILES["image"])) {
            $file = new File();
            $res = $file->uploadImg($_FILES["image"], 'public/employees_images/');
            if (!empty($res['location'])) {
                $data['image'] = $res['location'];
            }
        }
        $data['name'] = $_POST['name'];
        $data['address'] = $_POST['address'];
        $data['lat'] = floatval($_POST['lat']);
        $data['lng'] = floatval($_POST['lng']);
        $this->model('Employee')->createEmployee($data);
        header("Location: " . URL . "public/employees/index");
    }

    /*
     * get employee data by id in json format
     */
    public function getEmployeeData($id = '')
    {
        $employee = null;
        if (!empty($id)) {
            $employee = $this->model('Employee')->getEmployeeByID($id);
        }
        echo json_encode($employee);
    }

    /*
     * edit employee by id and returns its data in json format
     */
    public function editEmployeeData($id)
    {
        $employee = null;
        if (!empty($id)) {
            $data = array();
            if (isset($_FILES["image"])) {
                $file = new File();
                $res = $file->uploadImg($_FILES["image"], 'public/employees_images/');
                if (!empty($res['location'])) {
                    $data['image'] = $res['location'];
                }
            }
            $data['name'] = $_POST['name'];
            $data['address'] = $_POST['address'];
            $data['lat'] = floatval($_POST['lat']);
            $data['lng'] = floatval($_POST['lng']);
            $employee = $this->model('Employee')->editEmployee($id, $data);
        }
        echo json_encode($employee);
    }
}