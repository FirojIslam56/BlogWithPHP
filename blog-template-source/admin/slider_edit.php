<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>


<?php
    if (!isset($_GET['edit_slider_id']) OR $_GET['edit_slider_id']==NULL) {
         echo "<script>window.location='slider_list.php';</script>";
    }else{
        $edit_slider_id = $_GET['edit_slider_id'];
        $query = "SELECT * FROM table_slider WHERE id='$edit_slider_id' ";
        $get_slider_id = $db->select($query);
        if ($get_slider_id) {
            while ($result = $get_slider_id->fetch_assoc()) {
                if (Session::get('userId')!='1' ) {
                    echo "<script>alert('Only admin can edit slider list.')</script>";
                    echo "<script>window.location='slider_list.php';</script>";
                }
            }
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit slider list</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $title = $_POST['title'];

            $title = mysqli_real_escape_string($db->link, $title);

            $permited = array('jpg','jpeg','png');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp_name = $_FILES['image']['tmp_name'];

            $image_divission = explode('.', $file_name);
            $image_ext = strtolower(end($image_divission));
            $image_unique_name = substr(md5(time()), 0, 10).".".$image_ext;

            $folder = "uploadPhoto/sliderPhoto/".$image_unique_name;

            if ($title=="") {
                echo "<span style='color:red;font-size:20px;'> Title must not be empty !! </span>";
            }else{
                if ($file_name=="") {
                        $query_update = "UPDATE table_slider
                        SET
                        title    = '$title'
                        WHERE id='$edit_slider_id'
                    ";
                    $updated_slider = $db->update($query_update);
                    if ($updated_slider) {
                        echo "<span style='color:green;font-size:20px;'>Slider updated successfully. </span>";
                    }else{
                        echo "<span style='color:red;font-size:20px;'> Update failed !! </span>";
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

                        $query_update = "UPDATE table_post 
                        SET
                        title    = '$title',
                        image     = '$image_unique_name'
                        
                        WHERE id='$edit_slider_id'
                    ";
                    
                    $updated_slider = $db->update($query_update);
                    if ($updated_slider) {
                        echo "<span style='color:green;font-size:20px;'>Slider updated successfully. </span>";
                    }else{
                        echo "<span style='color:red;font-size:20px;'> Update failed !! </span>";
                    }
                }
            }
        }
        ?>
        <div class="block">
        <?php
            $query_post = "SELECT * FROM table_slider WHERE id='$edit_slider_id' ";
            $get_slider_all = $db->select($query_post);
            if ($get_slider_all) {
                while ($result_slider = $get_slider_all->fetch_assoc()) {
             
        ?>               
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">         
               
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $result_slider['title'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="uploadPhoto/sliderPhoto/<?php echo $result_slider['image'];?>" height="200px" width="350px" alt="post image"/></br>
                            <input type="file" name="image" />
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

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php include "inc/footerAdmin.php"?>