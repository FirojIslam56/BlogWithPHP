<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $cp_text = $_POST['cp_text']; 
    $cp_text = $fm->adminLoginValidation($_POST['cp_text']);
    $cp_text = mysqli_real_escape_string($db->link, $cp_text);

    if ($cp_text=="") {
        echo "<span style='color:red;font-size:20px;'> Filled must not be empty !! </span>";
    }else{
            $query_update = "UPDATE table_copyright 
            SET
            cp_text    = '$cp_text'
            WHERE id=1
            ";
            $updated_copyright = $db->update($query_update);
            if ($updated_copyright) {
                echo "<script>alert('Copyright text updated successfully.')</script>";
            }else{
                echo "<script>alert('Copyright text update failed..')</script>";
            }
        }
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
        <?php
            $query = "SELECT * FROM table_copyright WHERE id=1";
            $get_copyright = $db->select($query);
            if ($get_copyright) {
                while ($result_copyright = $get_copyright->fetch_assoc()) {
             
        ?>    
           <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result_copyright['cp_text'];?>" name="cp_text" class="large" />
                    </td>
                </tr>

                <tr> 
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
<?php include "inc/footerAdmin.php"?>