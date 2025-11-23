<?php
	// First include the database connection using correct relative path
	include __DIR__ . '/../includes/db_connect.php';
	// Then include the header
	include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <h1>Products Management</h1>
    <a href="add.php" class="btn">Add New Product</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
            
            while ($row = $stmt->fetch()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>$" . number_format($row['price'], 2) . "</td>
                    <td><img src='../{$row['image']}' alt='{$row['name']}' width='100'></td>
                    <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-edit'>Edit</a>
                        <a href='delete.php?id={$row['id']}' class='btn btn-delete'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include '../includes/footer.php';
?>