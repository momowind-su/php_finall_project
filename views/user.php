<?php require_once("parts/header_dashboard.php"); ?>
    <h1 class="text-center">User</h1>
    <div class="row">
        <div class="col">
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Second Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    echo "<tr>";
                        echo "<td>".$user->get_user_id()."</td>";
                        echo "<td>".$user->get_first_name()."</td>";
                        echo "<td>".$user->get_last_name()."</td>";
                        echo "<td>".$user->get_email()."</td>";
                        echo "<td>".$user->change_password_link()."</td>";
                    echo "</tr>";
                ?>
            </table>
        </div>
    </div>
<?php require_once("parts/footer.php"); ?>
