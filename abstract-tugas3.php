<?php
abstract class BaseModel {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    abstract public function selectById($id);

    abstract public function selectWhere($clause);

    abstract public function updateById($id, $name, $email, $role_fk);

    abstract public function updateWhere($clause, $name, $email, $role_fk);

    abstract public function deleteById($id);

    abstract public function deleteWhere($clause);
}
class StudentModel extends BaseModel {
    public function __construct($db) {
        parent::__construct($db);
    }
    public function selectById($id) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $stmt->close();
        return $student;
    }
    public function selectWhere($clause) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE $clause");
        $stmt->execute();
        $result = $stmt->get_result();
        $students = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $students;
    }
    public function updateById($id, $name, $email, $role_fk) {
        $stmt = $this->db->prepare("UPDATE students SET name = ?, email = ?, role_fk = ? WHERE id = ?");
        $stmt->bind_param("ssii", $name, $email, $role_fk, $id);
        $stmt->execute();
        $stmt->close();
    }
    public function updateWhere($clause, $name, $email, $role_fk) {
        $stmt = $this->db->prepare("UPDATE students SET name = ?, email = ?, role_fk = ? WHERE $clause");
        $stmt->bind_param("ssi", $name, $email, $role_fk);
        $stmt->execute();
        $stmt->close();
    }
    public function deleteById($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    public function deleteWhere($clause) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE $clause");
        $stmt->execute();
        $stmt->close();
    }
}
?>
