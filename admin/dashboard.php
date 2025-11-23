<?php
include __DIR__ . '/includes/db_connect.php';
include __DIR__ . '/includes/header.php';
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1><i class="fas fa-tachometer-alt"></i> Dashboard Overview</h1>
        <div class="current-date">
            <i class="far fa-calendar-alt"></i> <?php echo date('l, F j, Y'); ?>
        </div>
    </div>

    <div class="stats-grid">
        <!-- Total Products Card -->
        <div class="stat-card blue">
            <div class="stat-icon">
                <i class="fas fa-motorcycle"></i>
            </div>
            <div class="stat-content">
                <h3>Total Products</h3>
                <p>
                    <?php 
                    $stmt = $pdo->query("SELECT COUNT(*) FROM products");
                    echo $stmt->fetchColumn();
                    ?>
                </p>
                <a href="products/" class="stat-link">View Products <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="stat-card green">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-content">
                <h3>Total Orders</h3>
                <p>
                    <?php 
                    $stmt = $pdo->query("SELECT COUNT(*) FROM orders");
                    echo $stmt->fetchColumn();
                    ?>
                </p>
                <a href="orders/" class="stat-link">View Orders <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Total Contacts Card -->
        <div class="stat-card orange">
            <div class="stat-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-content">
                <h3>Total Contacts</h3>
                <p>
                    <?php 
                    $stmt = $pdo->query("SELECT COUNT(*) FROM contacts");
                    echo $stmt->fetchColumn();
                    ?>
                </p>
                <a href="contacts/" class="stat-link">View Messages <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="stat-card purple">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>Total Users</h3>
                <p>
                    <?php 
                    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
                    echo $stmt->fetchColumn();
                    ?>
                </p>
                <a href="users/" class="stat-link">View Users <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="dashboard-content">
        <!-- Recent Orders Section -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2><i class="fas fa-clock"></i> Recent Orders</h2>
                <a href="orders/" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("
                            SELECT o.id, o.customer_name, p.name as product_name, o.order_date 
                            FROM orders o
                            JOIN products p ON o.product_id = p.id
                            ORDER BY o.order_date DESC
                            LIMIT 5
                        ");
                        
                        while ($row = $stmt->fetch()) {
                            echo "<tr>
                                <td>#{$row['id']}</td>
                                <td>{$row['customer_name']}</td>
                                <td>{$row['product_name']}</td>
                                <td>" . date('M d, Y', strtotime($row['order_date'])) . "</td>
                                <td><span class='status-badge completed'>Completed</span></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Products Section -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2><i class="fas fa-star"></i> Popular Products</h2>
                <a href="products/" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="products-grid">
                <?php
                $stmt = $pdo->query("
                    SELECT p.*, COUNT(o.id) as order_count 
                    FROM products p
                    LEFT JOIN orders o ON p.id = o.product_id
                    GROUP BY p.id
                    ORDER BY order_count DESC, p.name ASC
                    LIMIT 4
                ");
                
                while ($row = $stmt->fetch()) {
                    echo "<div class='product-card'>
                        <div class='product-image'>
                            <img src='../{$row['image']}' alt='{$row['name']}'>
                            <div class='product-orders'><i class='fas fa-shopping-cart'></i> {$row['order_count']}</div>
                        </div>
                        <div class='product-details'>
                            <h3>{$row['name']}</h3>
                            <div class='product-price'>$" . number_format($row['price'], 2) . "</div>
                            <div class='product-actions'>
                                <a href='products/edit.php?id={$row['id']}' class='btn-edit'><i class='fas fa-edit'></i> Edit</a>
                            </div>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/includes/footer.php';
?>