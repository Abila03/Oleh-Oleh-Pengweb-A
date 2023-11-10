<?php
class Students {
     static function selectById($id) {
        global $conn; 
        $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $stmt->close();
        return $student;
    }
      static function selectWhere($clause) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM students WHERE $clause");
        $stmt->execute();
        $result = $stmt->get_result();
        $students = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $students;
    }
    static function updateById($id, $name, $email, $role_fk) {
        global $conn;
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, role_fk = ? WHERE id = ?");
        $stmt->bind_param("ssii", $name, $email, $role_fk, $id);
        $stmt->execute();
        $stmt->close();
    }
    static function updateWhere($clause, $name, $email, $role_fk) {
        global $conn; 
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, role_fk = ? WHERE $clause");
        $stmt->bind_param("ssi", $name, $email, $role_fk);
        $stmt->execute();
        $stmt->close();
    }
    static function deleteById($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    static function deleteWhere($clause) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM students WHERE $clause");
        $stmt->execute();
        $stmt->close();
    }
}
?>
