<?php
require_once "dbconfig.php";

class Database extends DBConfig
{
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        parent::connect();
    }

    public function create($data)
    {
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function read($id = null)
    {
        if ($id) {
            $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $this->conn->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function update($id, $data)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ", ");

        $sql = "UPDATE {$this->table} SET $set WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

class Student extends Database
{
    public function __construct()
    {
        parent::__construct("students");
    }
}

class Attendance extends Database
{
    public function __construct()
    {
        parent::__construct("attendance");
    }

    public function readAttendanceWithStudent()
    {
        $sql = "SELECT a.id, s.name, a.date, a.status 
                FROM attendance a 
                JOIN students s ON a.student_id = s.id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
