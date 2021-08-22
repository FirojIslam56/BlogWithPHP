<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
$role = Session::get('userRole');
//echo "my role is: ".$role;
if ($role!=1) {
    echo "<script>alert('Only admin can add user.')</script>";
    echo "<script>window.location='userlist.php';</script>";
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock"> 
            <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $username = $fm->adminLoginValidation($_POST['username']);
                $password = $fm->adminLoginValidation(md5($_POST['password']));
                $email = $fm->adminLoginValidation($_POST['email']);
                $role = $fm->adminLoginValidation($_POST['role']);

                $username = mysqli_real_escape_string($db->link, $username);
                $password = mysqli_real_escape_string($db->link, $password);
                $email = mysqli_real_escape_string($db->link, $email);
                $role = mysqli_real_escape_string($db->link, $role);


                $query = "SELECT * FROM table_user WHERE email='$email' ";
                $get_val = $db->select($query);
                if ($get_val==true) {
                 echo "<span style='color:red;font-size:20px'>This email already exixts.</span>";
                }else{

                    if ($username=='' OR $password=='' OR $email=='' OR $role==''){
                        echo "<span style='color:red;font-size:20px'>Fuild must not be empty !!</span>";
                    }elseif (!$email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<span style='color:red;font-size:20px'>Invalid email..!!</span>";
                    }
                    else{
                        $query = "INSERT INTO table_user(username,password,email,role) VALUES('$username','$password','$email','$role')";
                    $inserted_post = $db->insert($query);
                    if ($inserted_post) {
                        echo "<span style='color:green;font-size:20px;'> User insert successfully. </span>";
                    }else{
                        echo "<span style='color:red;font-size:20px;'> Insert failed !! </span>";
                    }
                    }
                }  
            }
        ?>
        <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter username..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" placeholder="Enter email..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Role</label>
                    </td>
                    <td>
                        <select id="select" name="role">
                            <option>Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Author</option>
                            <option value="3">Editor</option>
                        </select>
                    </td>
                </tr>
                <tr> 
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</div>
<?php include "inc/footerAdmin.php"?>