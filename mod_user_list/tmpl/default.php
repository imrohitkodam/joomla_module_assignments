<?php
defined('_JEXEC') or die;
?>

<style>
    /* Styling for the table */
    .user-table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Styling for table headers and cells */
    .user-table th,
    .user-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    /* Highlighting table headers */
    .user-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
</style>

<?php if (!empty($users)) : ?>
    <table class="user-table">
        <thead>
            <tr>
                <?php if ($showFullName) : ?>
                    <th>Full Name</th>
                <?php endif; ?>
                <?php if ($showUserName) : ?>
                    <th>Username</th>
                <?php endif; ?>
                <?php if ($showEmail) : ?>
                    <th>Email</th>
                <?php endif; ?>
                <?php if ($showRegistredDate) : ?>
                    <th>Registration Date</th>
                <?php endif; ?>
                <?php if ($showLastLoginDate) : ?>
                    <th>Last Login</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <?php if ($showFullName) : ?>
                        <td><?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                    <?php if ($showUserName) : ?>
                        <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                    <?php if ($showEmail) : ?>
                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                    <?php if ($showRegistredDate) : ?>
                        <td><?php echo htmlspecialchars($user->registerDate, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                    <?php if ($showLastLoginDate) : ?>
                        <td><?php echo htmlspecialchars($user->lastvisitDate, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No users found in the selected groups.</p>
<?php endif; ?>