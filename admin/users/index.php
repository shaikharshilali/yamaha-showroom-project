<?php
// First include the database connection
include __DIR__ . '/../includes/db_connect.php';
// Then include the header which needs authentication
include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Users Management</h1>
        <a href="add.php" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add New User
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM users ORDER BY creates_at DESC");
                
                while ($row = $stmt->fetch()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>" . date('M d, Y', strtotime($row['creates_at'])) . "</td>
                        <td class='actions'>
                            <a href='edit.php?id={$row['id']}' class='btn-edit' title='Edit'>
                                <i class='fas fa-edit'></i>
                            </a>
                            " . ($row['id'] != $_SESSION['user_id'] ? "
                            <a href='delete.php?id={$row['id']}' class='btn-delete' title='Delete' onclick='return confirm(\"Are you sure you want to delete this user?\")'>
                                <i class='fas fa-trash'></i>
                            </a>
                            " : "<span class='text-muted'>Current User</span>") . "
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