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
?>
