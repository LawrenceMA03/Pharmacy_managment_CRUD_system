<?php
require 'includes/db.php';
require 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $expiry_date = $_POST['expiry_date'];

    $stmt = $pdo->prepare("INSERT INTO products (name, description, quantity, price, expiry_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $quantity, $price, $expiry_date]);

    header("Location: index.php");
    exit();
}
?>

<h2>Add New Product</h2>
<form method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" required>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" required>

    <label for="expiry_date">Expiry Date:</label>
    <input type="date" name="expiry_date" required>

    <button type="submit">Add Product</button>
</form>

<?php require 'includes/footer.php'; ?>
