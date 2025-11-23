<?php
// First include the database connection using correct relative path
include __DIR__ . '/../includes/db_connect.php';
// Then include the header
include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <h1>Orders Management</h1>
    
    <div class="table-responsive">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Product</th>
                    <th>Buying</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("
                    SELECT o.*, p.name as product_name 
                    FROM orders o
                    JOIN products p ON o.product_id = p.id
                    ORDER BY o.order_date DESC
                ");
                
                while ($row = $stmt->fetch()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['customer_name']}</td>
                        <td>{$row['customer_email']}</td>
                        <td>{$row['product_name']}</td>
                        <td>{$row['buying']}</td>
                        <td>" . date('M d, Y H:i', strtotime($row['order_date'])) . "</td>
                        <td class='actions'>
                            <a href='#' class='btn-view' title='View'><i class='fas fa-eye'></i></a>
                            <a href='#' class='btn-print' title='Print'><i class='fas fa-print'></i></a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>