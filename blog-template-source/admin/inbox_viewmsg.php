<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    if (!isset($_GET['view_id']) OR $_GET['view_id']==NULL) {
        header("Location:inbox.php");
    }else{
        $view_id = $_GET['view_id'];
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        //header("Location:inbox.php");
        echo "<script>window.location='inbox.php';</script>";
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View inbox message</h2>
        <div class="block">  
        <?php
            $query = "SELECT * FROM table_contact WHERE id='$view_id' ";
                $get_view_msg = $db->select($query); 
                if ($get_view_msg) {
                    while ($result_view_msg = $get_view_msg->fetch_assoc()) {
        ?>             
           <form action="" method="POST">
            <table class="form">         
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result_view_msg['firstname'].' '.$result_view_msg['lastname'];?>" class="medium" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result_view_msg['email'];?>" class="medium" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $fm->myDate($result_view_msg['date']);?>" class="medium" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="tinymce" readonly>
                                <?php echo $result_view_msg['body'];?>       
                            </textarea>
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