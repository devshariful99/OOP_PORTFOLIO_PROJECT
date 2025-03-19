<?php

namespace App\Models;

use PDO;

class User
{
    private $conn;
    private $table = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $image;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function loginCheck($email, $password)
    {
        $query = "SELECT id, name, email, password FROM " . $this->table . " WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If user found and password is correct
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data for session handling
        }

        return false; // Login failed
    }


    public function users()
    {
        $query = "SELECT * FROM " . $this->table;
        $users = $this->conn->prepare($query);
        $users->execute();
        $users->setFetchMode(PDO::FETCH_ASSOC);
        return $users;
    }

    public function user()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $user = $this->conn->prepare($query);
        $user->bindParam(':id', $this->id, PDO::PARAM_INT);
        $user->execute();
        $result = $user->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " SET name=:name, image=:image, email=:email, password=:password";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET name=:name, email=:email, password=:password WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function checkEmailUnique($email, $userId = null)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        if ($userId) {
            $query .= " AND id != :id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        if ($userId) {
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function status()
    {
        $user = $this->user();
        $status = !$user['status'];

        $query = "UPDATE " . $this->table . " SET status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
