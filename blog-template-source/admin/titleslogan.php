<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>



<style type="text/css">
    .left-side{float: left;width: 70%;}
    .right-side{float: left;width: 20%;}
    .right-side img{width: 200px;height: 170px;}
</style>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $title = $_POST['title'];
    $slogan = $_POST['slogan'];

    $title = $fm->adminLoginValidation($_POST['title']);
    $slogan = $fm->adminLoginValidation($_POST['slogan']);

    $title = mysqli_real_escape_string($db->link, $title);
    $slogan = mysqli_real_escape_string($db->link, $slogan);

    $permited = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp_name = $_FILES['logo']['tmp_name'];

    $image_divission = explode('.', $file_name);
    $image_ext = strtolower(end($image_divission));
    //$image_fixed_name = "logo".".".$image_ext;
    $image_unique_name = substr(md5(time()), 0, 10).".".$image_ext;


    $folder = "uploadPhoto/".$image_unique_name;

    if ($title=="" OR $slogan=="") {
        echo "<span style='color:red;font-size:20px;'> Filled must not be empty !! </span>";
    }else{
        if ($file_name=="") {
            $query_update = "UPDATE table_slogan 
            SET
            title    = '$title',
            slogan     = '$slogan'  
            WHERE id=1
            ";
            $updated_slogan = $db->update($query_update);
            if ($updated_slogan) {
                echo "<script>alert('Slogan update successfully.')</script>";
            }else{
                echo "<script>alert('Slogan update failed..')</script>";
            }
        }
        elseif ($file_size > 2000000) {
            echo "<span style='color:red;font-size:20px;'> Image is too large !! </span>";
        }
        elseif (in_array($image_ext, $permited) === false) {
            echo "<span style='color:red;font-size:20px;'> Invalid image format !! </span>";
        }
        else{
            move_uploaded_file($file_temp_name, $folder);

            $query_update = "UPDATE table_slogan 
            SET
            title    = '$title',
            slogan     = '$slogan',
            logo     = '$image_unique_name'
            WHERE id=1
            ";
            $updated_slogan = $db->update($query_update);
            if ($updated_slogan) {
                echo "<script>alert('Slogan update successfully.')</script>";
            }else{
                echo "<script>alert('Slogan update failed..')</script>";
            }
        }
    }
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock"> 
            <?php
            $query = "SELECT * FROM table_slogan WHERE id=1";
            $get_slogan = $db->select($query);
            if ($get_slogan) {
                while ($result_slogan = $get_slogan->fetch_assoc()) {

                    ?>    

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="left-side"> 
                            <table class="form">                    
                                <tr>
                                    <td>
                                        <label>Website Title</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $result_slogan['title'];?>"  name="title" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Website Slogan</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $result_slogan['slogan'];?>" name="slogan" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Website Logo</label>
                                    </td>
                                    <td>
                                        <input type="file" name="logo" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="submit" Value="Update" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="right-side">
                            <img src="uploadPhoto/<?php echo $result_slogan['logo'];?>" height="100px" width="150px" alt="logo image"/>
                        </div>
                    </form>



                <?php } }?>   

            </div>
        </div>
    </div>


    <?php include "inc/footerAdmin.php"?>