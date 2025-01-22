<?php
require 'includes/db.php';
require 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $expiry_date = $_POST['expiry_date'];

    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, quantity = ?, price = ?, expiry_date = ? WHERE id = ?");
    $stmt->execute([$name, $description, $quantity, $price, $expiry_date, $id]);

    header("Location: index.php");
    exit();
}
?>

<h2>Edit Product</h2>
<form method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= $product['name'] ?>" required>

    <label for="description">Description:</label>
    <textarea name="description" required><?= $product['description'] ?></textarea>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>

    <label for="expiry_date">Expiry Date:</label>
    <input type="date" name="expiry_date" value="<?= $product['expiry_date'] ?>" required>

    <button type="submit">Update Product</button>
</form>

<?php require 'includes/footer.php'; ?>
