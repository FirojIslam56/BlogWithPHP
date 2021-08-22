<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    if (!isset($_GET['reply_id']) OR $_GET['reply_id']==NULL) {
        header("Location:inbox.php");
    }else{
        $reply_id = $_GET['reply_id'];
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $toEmail = $fm->adminLoginValidation($_POST['toEmail']);
        $fromEmail = $fm->adminLoginValidation($_POST['fromEmail']);
        $subject = $fm->adminLoginValidation($_POST['subject']);
        $message = $fm->adminLoginValidation($_POST['message']);

        $sendMail = mail($toEmail, $subject, $message, $fromEmail);
        if ($sendMail) {
            echo "<span style='color:green;'>Mail sent successful.</span>";
        }else{
            echo "<span style='color:red';>Mail sent failed...</span>";
        }
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View inbox message</h2>
        <div class="block">  
            <?php
                $query = "SELECT * FROM table_contact WHERE id='$reply_id' ";
                $get_reply_msg = $db->select($query); 
                if ($get_reply_msg) {
                    while ($result_reply_msg = $get_reply_msg->fetch_assoc()) {
            ?>
           <form action="" method="POST">
            <table class="form">         
                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" name="toEmail" value="<?php echo $result_reply_msg['email'];?>" class="medium" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text" name="fromEmail" placeholder="Enter your email.." class="medium"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" name="subject" placeholder="Enter your subject" class="medium"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea name="message" class="tinymce">
                                     
                            </textarea>
                        </td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Send" />
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