<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>


<?php
    if (!isset($_GET['view_post_id']) OR $_GET['view_post_id']==NULL) {
        header("Location:postlist.php");
    }else{
        $view_post_id = $_GET['view_post_id'];
    }
?>
<?php 
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        echo "<script>window.location='postlist.php';</script>";
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>View All Post</h2>
        <div class="block">
        <?php
            $query_post = "SELECT * FROM table_post WHERE id='$view_post_id' ";
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
                        <select id="select" readonly>
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
                            <input type="text" readonly value="<?php echo $result_post['title'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="uploadPhoto/<?php echo $result_post['image'];?>" height="100px" width="150px" alt="post image"/></br>
                            <input type="file" readonly />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" readonly><?php echo $result_post['body'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $result_post['author'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $result_post['tags'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="OK" />
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