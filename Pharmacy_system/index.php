<?php
require 'includes/db.php';
require 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Product List</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Expiry Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['description'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['expiry_date'] ?></td>
            <td>
                <a href="edit.php?id=<?= $product['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $product['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'includes/footer.php'; ?>
