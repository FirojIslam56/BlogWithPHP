<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
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
                    $query = "INSERT INTO table_page(page_name,page_body) VALUES('$page_name','$page_body')";
                    $inserted_page = $db->insert($query);
                    if ($inserted_page) {
                        echo "<span style='color:green;font-size:20px;'> Page insert successfully. </span>";
                    }else{
                        echo "<span style='color:red;font-size:20px;'> Insert failed !! </span>";
                    }
                }
            }
        ?>
        <div class="block">               
           <form action="" method="POST">
            <table class="form">         
                    <tr>
                        <td>
                            <label>Page Name:</label>
                        </td>
                        <td>
                            <input type="text" name="page_name" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="page_body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
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