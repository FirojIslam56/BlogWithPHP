<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>
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
                $userid = $_POST['userid'];

                $category = mysqli_real_escape_string($db->link, $category);
                $title = mysqli_real_escape_string($db->link, $title);
                $body = mysqli_real_escape_string($db->link, $body);
                $author = mysqli_real_escape_string($db->link, $author);
                $tags = mysqli_real_escape_string($db->link, $tags);
                $userid = mysqli_real_escape_string($db->link, $userid);

                $permited = array('jpg','jpeg','png');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp_name = $_FILES['image']['tmp_name'];

                $image_divission = explode('.', $file_name);
                $image_ext = strtolower(end($image_divission));
                $image_unique_name = substr(md5(time()), 0, 10).".".$image_ext;

                $folder = "uploadPhoto/".$image_unique_name;

                if ($category=="" OR $title=="" OR $file_name=="" OR $body=="" OR $author=="" OR $tags=="") {
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

                    $query = "INSERT INTO table_post(category,title,body,image,author,tags,userid) VALUES('$category','$title','$body','$image_unique_name','$author','$tags','$userid')";
                    $inserted_post = $db->insert($query);
                    if ($inserted_post) {
                        echo "<span style='color:green;font-size:20px;'> Post insert successfully. </span>";
                    }else{
                        echo "<span style='color:red;font-size:20px;'> Insert failed !! </span>";
                    }
                }

            }
        ?>
        <div class="block">               
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
                                        <option value="<?php echo $result['id'];?>"><?php echo $result['name'];?></option>
                                    <?php } }?>
                             </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo(Session::get('username'))?>" class="medium" />
                            <input type="hidden" name="userid" value="<?php echo(Session::get('userId'))?>" readonly class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" placeholder="Enter Post tags..." class="medium" />
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