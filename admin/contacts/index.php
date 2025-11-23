<?php
// First include the database connection
include __DIR__ . '/../includes/db_connect.php';
// Then include the header
include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <h1>Contact Messages</h1>
    
    <div class="table-responsive">
        <table class="contacts-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submission Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM contacts ORDER BY submission DESC");
                
                while ($row = $stmt->fetch()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td><a href='mailto:{$row['email']}'>{$row['email']}</a></td>
                        <td class='message-content'>" . nl2br(htmlspecialchars($row['message'])) . "</td>
                        <td>" . date('M d, Y H:i', strtotime($row['submission'])) . "</td>
                        <td class='actions'>
                            <a href='mailto:{$row['email']}' class='btn-reply' title='Reply'><i class='fas fa-reply'></i></a>
                            <a href='delete.php?id={$row['id']}' class='btn-delete' title='Delete' onclick='return confirm(\"Are you sure you want to delete this message?\")'><i class='fas fa-trash'></i></a>
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