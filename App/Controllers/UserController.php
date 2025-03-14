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
        $users = $this->userModel->users();
        require_once "../App/Views/User/index.php";
    }

    public function create()
    {
        require_once "../App/Views/User/create.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $name = trim($_POST['name']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);
            $errors = [];

            // Validation checks
            if (empty($name)) {
                $errors[] = "Name field is required.";
            }
            if (empty($email)) {
                $errors[] = "Email field is required.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }
            $existingUser = $this->userModel->checkEmailUnique($email);
            if ($existingUser) {
                $errors[] = "Email is already taken.";
            }

            if (empty($password)) {
                $errors[] = "Password field is required.";
            }
            if (!empty($password) && strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            }

            if (empty($confirm_password)) {
                $errors[] = "Confirm Password field is required.";
            }

            if (!empty($password) && $password !== $confirm_password) {
                $errors[] = "Passwords do not match.";
            }



            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /user/create");
            } else {
                $this->userModel->email = $email;
                $this->userModel->name = $name;
                $this->userModel->password = password_hash($password, PASSWORD_DEFAULT);
                if ($this->userModel->create()) {
                    header("Location: /user/index");
                }
            }
        }
    }

    public function edit($id)
    {
        $this->userModel->id = $id;
        $user = $this->userModel->user();
        require_once "../App/Views/User/edit.php";
    }


    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $name = trim($_POST['name']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);
            $errors = [];

            // Validation checks
            if (empty($name)) {
                $errors[] = "Name field is required.";
            }
            if (empty($email)) {
                $errors[] = "Email field is required.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }
            $existingUser = $this->userModel->checkEmailUnique($email, $id);
            if ($existingUser) {
                $errors[] = "Email is already taken.";
            }
            if (!empty($password) && strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            }
            if (!empty($password) && $password !== $confirm_password) {
                $errors[] = "Passwords do not match.";
            }



            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /user/edit/$id");
            } else {
                $this->userModel->id = $id;
                $user = $this->userModel->user();
                if ($user['id']) {
                    $this->userModel->email = $email;
                    $this->userModel->name = $name;
                    $this->userModel->password = $password ? password_hash($password, PASSWORD_DEFAULT) : $user['password'];
                    if ($this->userModel->update()) {
                        header("Location: /user/index");
                    }
                } else {
                    header("Location: /user/index");
                }
            }
        }
    }

    public function status($id)
    {
        $this->userModel->id = $id;
        if ($this->userModel->status()) {
            header("Location: /user/index");
        }
    }
    public function delete($id)
    {
        $this->userModel->id = $id;
        if ($this->userModel->delete()) {
            header("Location: /user/index");
        }
    }
}
