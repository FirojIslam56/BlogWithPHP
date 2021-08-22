<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    if (!isset($_GET['page_id']) OR $_GET['page_id']==NULL) {
        header("Location:index.php");
    }else{
        $page_id = $_GET['page_id'];
    }
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update page</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $page_name = $_POST['page_name'];
                $page_body = $_POST['page_body'];

                // $page_name = $fm->adminLoginValidation($_POST['page_name']);
                // $page_body = $fm->adminLoginValidation($_POST['page_body']);

                 // $page_name = mysqli_real_escape_string($db->link, $page_name);
                 // $page_body = mysqli_real_escape_string($db->link, $page_body);

                if ($page_name=="" OR $page_body=="") {
                    echo "<span style='color:red;font-size:20px;'> Filled must not be empty !! </span>";
                }
                else{
                    $query_update = "UPDATE table_page
                        SET
                        page_name    = '$page_name',
                        page_body     = '$page_body'
                        WHERE id='$page_id'
                        ";
                        $updated_page_type = $db->update($query_update);
                        if ($updated_page_type) {
                            //echo "<script>alert('Page type updated successfully.')</script>";
                            echo "<span style='color:green;font-size:20px;'> updated successfully. </span>";
                        }else{
                            //echo "<script>alert('Page type update failed..')</script>";
                            echo "<span style='color:red;font-size:20px;'>not updated successfully. </span>";
                        }
                }
            }
        ?>
        <div class="block">  
        <?php
            $query = "SELECT * FROM table_page WHERE id='$page_id' ";
            $get_page_type = $db->select($query); 
            if ($get_page_type) {
                while ($result_page_type = $get_page_type->fetch_assoc()) {
                 
        ?>             
           <form action="" method="POST">
            <table class="form">         
                    <tr>
                        <td>
                            <label>Page Name:</label>
                        </td>
                        <td>
                            <input type="text" name="page_name" value="<?php echo $result_page_type['page_name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="page_body">
                                <?php echo $result_page_type['page_body'];?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update"/>
                            <button style="font-size: 22px;font-family: Arial Narrow;"><a onclick="return confirm('Are you sure to delete ?')" href="page_delete.php?delid=<?php echo $result_page_type['id'];?>">Delete</a></button>
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