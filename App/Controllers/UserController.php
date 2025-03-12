<?php

namespace App\Controllers;

use App\Models\User;
use App\Config\Database;

class UserController
{
    private $db;
    private $userModel;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['user_name'])) {
            header("Location: /");
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
    }

    public function dashboard()
    {
        require_once "../App/Views/dashboard.php";
    }

    public function index()
    {
        $stmt = $this->userModel->users();
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        require_once "../App/Views/User/index.php";
    }

    // public function store()
    // {
    //     $this->userModel->name = $_POST['name'];
    //     $this->userModel->email = $_POST['email'];
    //     if ($this->userModel->create()) {
    //         header("Location: /");
    //     }
    // }

    // public function destroy()
    // {
    //     $this->userModel->id = $_GET['id'];
    //     if ($this->userModel->delete()) {
    //         header("Location: /");
    //     }
    // }
}
