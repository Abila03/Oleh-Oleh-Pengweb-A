<?php
function displayAdminLoginForm() {
    include 'view/admin-panel/admin-login.php';
}
function displayAdminDashboard() {
    include 'view/admin-panel/admin-dashboard.php';
}
function displayCustomerRegistrationForm() {
    include 'view/forms/customer-register.php';
}
function displayCustomerProfile() {
    include 'view/forms/customer-profile.php';
}
function displayItemDetails($id) {
    include 'view/shop/item.php';
}
function displayItemList() {
    include 'view/shop/home.php';
}
function displayCart() {
    include 'view/shop/cart.php';
}
function displayOrderDetails($id) {
    include 'view/shop/order.php';
}
function displayOrderList() {
    include 'view/shop/order.php';
}
function displayContactPage() {
    include 'view/shop/contact.php';
}
function displayHomePage() {
    include 'view/home.php';
}
function processLogin($username, $password) {
    $isValidLogin = validasi($username, $password);
    if ($isValidLogin) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Login failed. Please check your username and password.";
    }
    function validasi($username, $password) {
        $db = new mysqli("localhost", "username", "password", "nama_database");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
            return true;
            } else {
            return false;
            }
        } else {
        return false;
        }
        $db->close();
    }
}
function processRegistration($username, $password, $email) {
    $registrationSuccess = register($username, $password, $email);
    if ($registrationSuccess) {
        header("Location: login.php?status=success");
        exit();
    } else {
        echo "Registration failed. Please try again.";
    }
    function register($username, $password, $email) {
        $db = new mysqli("localhost", "username", "password", "nama_database");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $username = $db->real_escape_string($username);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $email = $db->real_escape_string($email);
        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";
        if ($db->query($query) === TRUE) {
            $db->close();
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            $db->close();
            return false;
        }
    }        
}
function processProfileEditing($customerId, $newUsername, $newEmail) {
    $profileUpdateSuccess = editUserProfile($customerId, $newUsername, $newEmail);
    if ($profileUpdateSuccess) {
        header("Location: profile.php?action=edited");
        exit();
    } else {
        echo "Profile editing failed. Please try again.";
    }
    function editUserProfile($customerId, $newUsername, $newEmail) {
        $db = new mysqli("localhost", "username", "password", "nama_database");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $customerId = $db->real_escape_string($customerId);
        $newUsername = $db->real_escape_string($newUsername);
        $newEmail = $db->real_escape_string($newEmail);
        $query = "UPDATE users SET username = '$newUsername', email = '$newEmail' WHERE id = '$customerId'";
        if ($db->query($query) === TRUE) {
            $db->close();
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            $db->close();
            return false;
        }
    }
}
function processLogout() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php?status=logged_out");
    exit();
}
?>
