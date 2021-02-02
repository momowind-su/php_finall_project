<?php require_once("parts/header_dashboard.php"); ?>
    <h1 class="text-center">Users</h1>
    <?php if($user_role == 'admin'): ?>
    <a class="btn btn-primary" href="/?m=user&a=create_user">Add new user</a>
    <?php endif; ?>
    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Second Name</th>
                    <th>Email</th>
                    <th></th>
                    <?php if($user_role == 'admin'): ?>
                        <th></th>
                        <th></th>
                    <?php endif; ?>

                </tr>
                <?php 
                foreach($users as $user){
                    echo "<tr>";
                        echo "<td>".$user->get_user_id()."</td>";
                        echo "<td>".$user->get_first_name()."</td>";
                        echo "<td>".$user->get_last_name()."</td>";
                        echo "<td>".$user->get_email()."</td>";
                        echo "<td>".$user->link_to_user()."</td>";
                        if($user_role == 'admin'){
                            echo "<td>".$user->link_to_update()."</td>";
                            echo "<td>".$user->link_to_delete()."</td>";
                        }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
<?php require_once("parts/footer.php"); ?>
