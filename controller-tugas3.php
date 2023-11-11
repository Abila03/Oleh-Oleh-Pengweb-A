<?php
class RoleController {
    static function getRoles($id) {
        $roles = []; 
        if ($id == 1) {
            $roles[] = "Admin";
            $roles[] = "User";
        } elseif ($id == 2) {
            $roles[] = "Editor";
            $roles[] = "Viewer";
        } else {
        }
        header('Content-Type: application/json');
        echo json_encode($roles);
    }
}
?>
