<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>


<?php
    if (!isset($_GET['edit_post_id']) OR $_GET['edit_post_id']==NULL) {
        header("Location:postlist.php");
    }else{
        $edit_post_id = $_GET['edit_post_id'];
        $query = "SELECT * FROM table_post WHERE id='$edit_post_id' ";
        $get_usrid = $db->select($query);
        if ($get_usrid) {
            while ($result = $get_usrid->fetch_assoc()) {
                $usrID = $result['userid'];
                if ($usrID != Session::get('userId') AND Session::get('userId')!='1' ) {
                    echo "<script>alert('You can not edit this post.')</script>";
                    echo "<script>window.location='postlist.php';</script>";
                }
            }
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $category = $_POST['category'];
            $title = $_POST['title'];
            $body = $_POST['body'];
            $author = $_POST['author'];
            $tags = $_POST['tags'];

            $category = mysqli_real_escape_string($db->link, $category);
            $title = mysqli_real_escape_string($db->link, $title);
            $body = mysqli_real_escape_string($db->link, $body);
            $author = mysqli_real_escape_string($db->link, $author);
            $tags = mysqli_real_escape_string($db->link, $tags);

            $permited = array('jpg','jpeg','png');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp_name = $_FILES['image']['tmp_name'];

            $image_divission = explode('.', $file_name);
            $image_ext = strtolower(end($image_divission));
            $image_unique_name = substr(md5(time()), 0, 10).".".$image_ext;

            $folder = "uploadPhoto/".$image_unique_name;

            if ($category=="" OR $title=="" OR $body=="" OR $author=="" OR $tags=="") {
                echo "<span style='color:red;font-size:20px;'> Filled must not be empty !! </span>";
            }else{
                if ($file_name=="") {
                    if (Session::get('userId')=='1') {
                        $query_update = "UPDATE table_post 
                        SET
                        category = '$category',
                        title    = '$title',
                        body     = '$body',
                        author   = '$author',
                        tags     = '$tags',
                        adminID   = '1'
                        
                        WHERE id='$edit_post_id'
                    ";
                    }else{
                    $query_update = "UPDATE table_post 
                        SET
                        category = '$category',
                        title    = '$title',
                        body     = '$body',
                        author   = '$author',
                        tags     = '$tags'
                        
                        WHERE id='$edit_post_id'
                    ";}
                    $updated_post = $db->update($query_update);
                    if ($updated_post) {
                        echo "<span style='color:green;font-size:20px;'> Post update successfully. </span>";
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

                    if (Session::get('userId')=='1') {
                        $query_update = "UPDATE table_post 
                        SET
                        category = '$category',
                        title    = '$title',
                        body     = '$body',
                        image     = '$image_unique_name',
                        author   = '$author',
                        tags     = '$tags',
                        adminID   = '1' 
                        
                        WHERE id='$edit_post_id'
                    ";
                    }
                    $query_update = "UPDATE table_post 
                        SET
                        category = '$category',
                        title    = '$title',
                        body     = '$body',
                        image     = '$image_unique_name',
                        author   = '$author',
                        tags     = '$tags'
                        
                        WHERE id='$edit_post_id'
                    ";
                    $updated_post = $db->update($query_update);
                    if ($updated_post) {
                        echo "<span style='color:green;font-size:20px;'> Post update successfully. </span>";
                    }else{
                        echo "<span style='color:red;font-size:20px;'> Update failed !! </span>";
                    }
                }
            }
        }
        ?>
        <div class="block">
        <?php
            $query_post = "SELECT * FROM table_post WHERE id='$edit_post_id' ";
            $get_post_all = $db->select($query_post);
            if ($get_post_all) {
                while ($result_post = $get_post_all->fetch_assoc()) {
                    # code...
             
        ?>               
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">         
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select</option>
                            <?php
                            $query = "SELECT * FROM table_category";
                            $get_category = $db->select($query);
                            if ($get_category) {
                                while ($result = $get_category->fetch_assoc()) {
                                    ?>
                                    
                                    <option 
                                    <?php 
                                        if ($result_post['category']==$result['id']) { 
                                    ?>
                                        selected = 'selected';
                                    <?php }?>
                                     value="<?php echo $result['id'];?>"><?php echo $result['name'];?>
                                         
                                     </option>

                                <?php } }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $result_post['title'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="uploadPhoto/<?php echo $result_post['image'];?>" height="100px" width="150px" alt="post image"/></br>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"><?php echo $result_post['body'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $result_post['author'];?>" class="medium" />
                            <input type="hidden" name="adminID" readonly class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" value="<?php echo $result_post['tags'];?>" class="medium" />
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