<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    if (Session::get('userRole')!=1) {
        echo "<script>alert('Only admin can add new slider.')</script>";
        echo "<script>window.location='index.php';</script>";
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Slider</h2>
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

                if ($title=="" OR $file_name=="") {
                    echo "<span style='color:red;font-size:20px;'> Filled must not be empty !! </span>";
                }
                elseif ($file_size > 2000000) {
                    echo "<span style='color:red;font-size:20px;'> Image is too large !! </span>";
                }
                elseif (in_array($image_ext, $permited) === false) {
                    echo "<span style='color:red;font-size:20px;'> Invalid image format !! </span>";
                }
                else{
                    move_uploaded_file($file_temp_name, $folder);

                    $query = "INSERT INTO  table_slider(title,image) VALUES('$title','$image_unique_name')";
                    $inserted_slider = $db->insert($query);
                    if ($inserted_slider) {
                        echo "<span style='color:green;font-size:20px;'> Slider insert successfully. </span>";
                    }else{
                        echo "<span style='color:red;font-size:20px;'>Slider Insert failed !! </span>";
                    }
                }

            }
        ?>
        <div class="block">               
           <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">         
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Slider Title..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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