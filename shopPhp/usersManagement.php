<?php
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    include_once 'includes/usersManagement.inc.php';
?>
    <h1>Users Management</h1>
    
    <table>
        <thead>
            <th>User Name</th>
            <th>Role</th>
            <th>Actions</th>
        </thead>
        <?php for($i = 0; $i < count($users); $i++): ?>
            <tr>
                <td><?php echo $users[$i]["Login"] ?></td>
                <td><?php echo $users[$i]["Role"] ?></td>
                <td>                    
                    <?php if ($users[$i]["Role"] != 'user'): ?>
                        <form action='includes/usersManagement.inc.php' method='GET'>
                            <input type='hidden' name='userId' value='<?php echo $users[$i]["Id"] ?>'/>
                            <input type='hidden' name='currentRole' value='<?php echo $users[$i]["Role"] ?>'/>
                            <input type='hidden' name='action' value='DEMOTE'/>
                            <button type='submit' label='Demote'>↓</button>
                        </form>
                    <?php endif; ?>
                    
                    <?php if ($users[$i]["Role"] != 'admin'): ?>
                        <form action='includes/usersManagement.inc.php' method='GET'>
                            <input type='hidden' name='userId' value='<?php echo $users[$i]["Id"] ?>'/>
                            <input type='hidden' name='currentRole' value='<?php echo $users[$i]["Role"] ?>'/>
                            <input type='hidden' name='action' value='PROMOTE'/>
                            <button type='submit' label='Promote'>↑</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endfor; ?>
    </table>

<?php
    include_once 'footer.php';
?>