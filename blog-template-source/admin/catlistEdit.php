<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    if (!isset($_GET['catid']) OR $_GET['catid']==NULL) {
        header("Location:catlist.php");
    }else{
        $cat_id = $_GET['catid'];
    }
?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
            <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if (empty($name)) {
                    echo "<span style='color:red;font-size:20px'>Fuild must not be empty !!</span>";
                }else{
                    $query = "UPDATE table_category SET name='$name' WHERE id='$cat_id' ";
                    $updateCat = $db->update($query);
                    if ($updateCat) {
                        echo "<span style='color:green;font-size:20px'>Updated Successfully.</span>";
                    }else{
                        echo "<span style='color:red;font-size:20px'>Not Update !!</span>";
                    }
                }
            }
            ?>

            <?php
                $query = "SELECT * FROM table_category WHERE id=$cat_id ";
                $get_cat = $db->select($query);
                if ($get_cat) {
                    while ($result = $get_cat->fetch_assoc()) {    
            ?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
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