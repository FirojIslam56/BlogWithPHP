<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $youtube = $_POST['youtube'];
    

    $facebook = $fm->adminLoginValidation($_POST['facebook']);
    $twitter = $fm->adminLoginValidation($_POST['twitter']);
    $instagram = $fm->adminLoginValidation($_POST['instagram']);
    $youtube = $fm->adminLoginValidation($_POST['youtube']);

    $facebook = mysqli_real_escape_string($db->link, $facebook);
    $twitter = mysqli_real_escape_string($db->link, $twitter);
    $instagram = mysqli_real_escape_string($db->link, $instagram);
    $youtube = mysqli_real_escape_string($db->link, $youtube);

    if ($facebook=="" OR $twitter=="" OR $instagram=="" OR $youtube=="") {
        echo "<span style='color:red;font-size:20px;'> Filled must not be empty !! </span>";
    }else{
            $query_update = "UPDATE table_social 
            SET
            facebook    = '$facebook',
            twitter     = '$twitter',
            instagram     = '$instagram',
            youtube     = '$youtube'
            WHERE id=1
            ";
            $updated_social = $db->update($query_update);
            if ($updated_social) {
               // echo "<span style='color:green;font-size:20px;'> Slogan update successfully. </span>";
                echo "<script>alert('Social link updated successfully.')</script>";
            }else{
                //echo "<span style='color:red;font-size:20px;'> Slogan Update failed !! </span>";
                echo "<script>alert('Social link update failed..')</script>";
            }
        }
}
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">    
                <?php 
                    $query = "SELECT * FROM table_social WHERE id=1";
                    $get_social_lnik = $db->select($query);
                    if ($get_social_lnik) {
                        while ($result_sl = $get_social_lnik->fetch_assoc()) {
                ?>           
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $result_sl['facebook'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $result_sl['twitter'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Instagram</label>
                            </td>
                            <td>
                                <input type="text" name="instagram" value="<?php echo $result_sl['instagram'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>YouTube</label>
                            </td>
                            <td>
                                <input type="text" name="youtube" value="<?php echo $result_sl['youtube'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } }?>    
                </div>
            </div>
        </div>
        
<?php include "inc/footerAdmin.php"?>