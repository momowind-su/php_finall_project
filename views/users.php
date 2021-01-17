<?php require_once("parts/header.php"); ?>
<h1>User</h1>
<div>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Second Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php 
        foreach($users as $user){
            echo "<tr>";
                echo "<td>".$user->get_user_id()."</td>";
                echo "<td>".$user->get_first_name()."</td>";
                echo "<td>".$user->get_last_name()."</td>";
                echo "<td>".$user->get_email()."</td>";
                echo "<td><a href='/?m=user&a=show_user&id=".($user->get_user_id())."' class='btn btn-primary'>Watch</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<?php require_once("parts/footer.php"); ?>
