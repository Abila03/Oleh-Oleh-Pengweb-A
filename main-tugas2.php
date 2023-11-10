<?php
require_once 'functions-tugas2.php';
$path = $_SERVER['REQUEST_URI'];
$parts = explode('/', $path);
$action = end($parts);
switch ($action) {
    case 'admin':
        if ($_GET['loggedIn'] == 'true') {
            displayAdminDashboard();
        } else {
            displayAdminLoginForm();
        }
        break;
    case 'login':
        if ($_GET['status'] == 'true') {
            // Handle login save action
            processLogin();
        } else {
            displayAdminLoginForm();
        }
        break;
    case 'register':
        if ($_GET['action'] == 'save') {
            // Handle registration save action
            processRegistration();
        } else {
            displayCustomerRegistrationForm();
        }
        break;
    case 'profile':
        if ($_GET['action'] == 'edited') {
            processProfileEditing();
        } else {
            displayCustomerProfile();
        }
        break;
    case 'item':
        $id = $_GET['id'];
        if ($id) {
            displayItemDetails($id);
        } else {
            displayItemList();
        }
        break;
    case 'cart':
        displayCart();
        break;
    case 'order':
        $id = $_GET['id'];
        if ($id) {
            displayOrderDetails($id);
        } else {
            displayOrderList();
        }
        break;
    case 'contact':
        displayContactPage();
        break;
    case 'logout':
        processLogout();
        break;
    default:
        displayHomePage();
}
?>
