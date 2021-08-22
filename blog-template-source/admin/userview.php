<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    if (isset($_GET['userview_id'])) {
        $userview_id = $_GET['userview_id'];
    }else{
        echo "<span style='color:red;font-size:20px'>No user availabe...</span>";
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        echo "<script>window.location='userlist.php';</script>";
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View User Details</h2>
        <div class="block">  
        <?php
            $query = "SELECT * FROM table_user WHERE id='$userview_id' ";
                $get_user_details = $db->select($query); 
                if ($get_user_details) {
                    while ($result_ud = $get_user_details->fetch_assoc()) {
        ?>             
           <form action="" method="POST">
            <table class="form">         
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result_ud['name'];?>" class="medium" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result_ud['username'];?>" class="medium" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result_ud['email'];?>" class="medium" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea class="tinymce" readonly>
                                <?php echo $result_ud['details'];?>       
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