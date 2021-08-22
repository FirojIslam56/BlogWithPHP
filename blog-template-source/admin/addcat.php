<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
            <?php 
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if (empty($name)) {
                    echo "<span style='color:red;font-size:20px'>Fuild must not be empty !!</span>";
                }else{
                    $query = "INSERT INTO table_category(name) VALUES('$name')";
                    $insertCat = $db->insert($query);
                    if ($insertCat) {
                        echo "<span style='color:green;font-size:20px'>Inserted Successfully.</span>";
                    }else{
                        echo "<span style='color:red;font-size:20px'>Not Inserted !!</span>";
                    }
                }
            }
            ?>
           <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</div>
<?php include "inc/footerAdmin.php"?>