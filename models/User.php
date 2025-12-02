<?php
class User
{
    private $conn;
    private $table = 'users';

    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $password;
    public $service;
    public $role;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function authenticate($email, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $this->id = $row['id'];
                $this->nom = $row['nom'];
                $this->prenom = $row['prenom'];
                $this->email = $row['email'];
                $this->service = $row['service'];
                $this->role = $row['role'];
                return true;
            }
        }
        return false;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->email = $row['email'];
            $this->service = $row['service'];
            $this->role = $row['role'];
            return true;
        }
        return false;
    }
}
