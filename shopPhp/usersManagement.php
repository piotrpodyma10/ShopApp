<?php
    include_once 'css.php';
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    include_once 'includes/usersManagement.inc.php';
    include_once './style/additional.php';
?>
    <h1>Users Management</h1>
    <div>
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
                            <button id="down" type='submit' label='Demote'>↓</button>
                        </form>
                    <?php endif; ?>
                    
                    <?php if ($users[$i]["Role"] != 'admin'): ?>
                        <form action='includes/usersManagement.inc.php' method='GET'>
                            <input type='hidden' name='userId' value='<?php echo $users[$i]["Id"] ?>'/>
                            <input type='hidden' name='currentRole' value='<?php echo $users[$i]["Role"] ?>'/>
                            <input type='hidden' name='action' value='PROMOTE'/>
                            <button id="up" type='submit' label='Promote'>↑</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endfor; ?>
        <!-- <style>.banner{display:none;} body{background-color:black; color:white; font-size:20px;} a{color:lawngreen; text-decoration: underline }</style> -->
        
    </table>

</div>
<div id="footer">
                <div id="footerBox">
                    <div class="icon-facebook-rect icon"></div>
                    <div class="icon-twitter icon"></div>
                    <div class="icon-email icon"></div>
                    <div class="footerText">Brave King</div>
                </div>
</div>