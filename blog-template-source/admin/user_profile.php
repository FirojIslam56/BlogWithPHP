<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    $userId = Session::get('userId');
    $userRole = Session::get('userRole');
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Profile</h2>
        <div class="block copyblock"> 
            <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $name = $fm->adminLoginValidation($_POST['name']);
                $username = $fm->adminLoginValidation($_POST['username']);
                $email = $fm->adminLoginValidation($_POST['email']);
                $details = $fm->adminLoginValidation($_POST['details']);

                $name = mysqli_real_escape_string($db->link, $name);
                $username = mysqli_real_escape_string($db->link, $username);
                $email = mysqli_real_escape_string($db->link, $email);
                $details = mysqli_real_escape_string($db->link, $details);

                if (empty($name) OR empty($username) OR empty($email) OR empty($details)) {
                    echo "<span style='color:red;font-size:20px'>Fuild must not be empty !!</span>";
                }else{
                    $query = "UPDATE table_user 
                    SET 
                    name='$name', 
                    username='$username',
                    email='$email',
                    details='$details'
                    WHERE id='$userId' ";

                    $update_prifile = $db->update($query);
                    if ($update_prifile) {
                        echo "<span style='color:green;font-size:20px'>Profile Updated Successfully.</span>";
                    }else{
                        echo "<span style='color:red;font-size:20px'>Profile Not Update !!</span>";
                    }
                }
            }
            ?>

            <?php
                $query = "SELECT * FROM table_user WHERE id='$userId' AND role='$userRole' ";
                $get_user = $db->select($query);
                if ($get_user) {
                    while ($result_user = $get_user->fetch_assoc()) {    
            ?>
            <form action="" method="POST">
                <table class="form">                    
                    <tr>
                        <td><label>Name</label></td>
                        <td>
                            <input type="text" name="name" value="<?php echo $result_user['name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Username</label></td>
                        <td>
                            <input type="text" name="username" value="<?php echo $result_user['username'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Email</label></td>
                        <td>
                            <input type="text" name="email" value="<?php echo $result_user['email'];?>" class="medium" />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="details">
                                <?php echo $result_user['details'];?>       
                            </textarea>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Update Profile" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php } }?>
        </div>
    </div>
</div>
<?php include "inc/footerAdmin.php"?>