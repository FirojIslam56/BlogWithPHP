<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Themes</h2>
        <div class="block copyblock"> 
            <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $themes = $_POST['themes'];
                $themes = mysqli_real_escape_string($db->link, $themes);
                if (empty($themes)) {
                    echo "<span style='color:red;font-size:20px'>Fuild must not be empty !!</span>";
                }else{
                    $query = "UPDATE table_themes SET themes='$themes' WHERE id='1' ";
                    $update_themes = $db->update($query);
                    if ($update_themes) {
                        echo "<span style='color:green;font-size:20px'>Themes changed Successfully.</span>";
                    }else{
                        echo "<span style='color:red;font-size:20px'>Themes not changed... !!</span>";
                    }
                }
            }
            ?>

            <?php
                $query = "SELECT * FROM table_themes WHERE id='1' ";
                $get_themes = $db->select($query);
                if ($get_themes) {
                    while ($result = $get_themes->fetch_assoc()) {    
            ?>
            <form action="" method="POST"> 
                <table class="form">                    
                    <tr>
                      <td>
                          <input <?php if ($result['themes']=='default') {
                              echo "checked";
                          }?> type="radio" name="themes" value="default" />Default
                      </td>
                    </tr>
                    <tr>
                        <td>
                             <input <?php if ($result['themes']=='green') {
                              echo "checked";
                          }?> type="radio" name="themes" value="green"  />Green
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Change" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php } }?>
        </div>
    </div>
</div>
<?php include "inc/footerAdmin.php"?>