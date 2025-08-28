<?php
class Database {
    private $host = "localhost";
    private $dbname = "schooldb";
    private $username = "root";
    private $password = "";
    protected $conn;

    
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", 
                                  $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // CREATE
    public function create($table, $data) {
        $keys = implode(",", array_keys($data));
        $vals = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($vals)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // READ
    public function read($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($table, $data, $id) {
        $fields = "";
        foreach ($data as $key => $val) {
            $fields .= "$key = :$key,";
        }
        $fields = rtrim($fields, ",");
        $sql = "UPDATE $table SET $fields WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // DELETE
    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
