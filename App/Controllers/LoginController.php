<?php

namespace App\Controllers;

use App\Models\User;
use App\Config\Database;

class LoginController
{
    private $db;
    private $userModel;

    public function __construct()
    {
        session_start();
        if (isset($_SESSION['user_name'])) {
            header("Location: /dashboard");
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
    }

    public function login()
    {
        require_once "../App/Views/Auth/login.php";
    }

    public function loginCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);
            $errors = [];

            // Validation checks
            if (empty($email) || empty($password)) {
                $errors[] = "Email and Password are required.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            }



            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /");
            } else {

                // Call the login method from the User model
                $user = $this->userModel->loginCheck($_POST['email'], $_POST['password']);
                if ($user) {
                    // Start session and store user data
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_email'] = $user['email'];

                    $success = "Login Successful! Welcome, " . $_SESSION['user_name'];
                    $_SESSION['success'] = $success;
                    header("Location: /dashboard");
                    exit();
                } else {
                    $errors[] = 'Invalid email or password.';
                    $_SESSION['errors'] = $errors;
                    header("Location: /");
                }
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        session_unset();
        header("Location: /");
    }
}
