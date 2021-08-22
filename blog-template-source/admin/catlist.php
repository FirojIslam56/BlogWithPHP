<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    if (!isset($_GET['del_catid']) OR $_GET['del_catid']==NULL) {
        //echo "<span style='color:red;font-size:20px'>Error !!</span>";
    }else{
        $del_cat_id = $_GET['del_catid'];
        $query = "DELETE FROM table_category WHERE id='$del_cat_id' ";
        $deleted_cat = $db->delete($query);
        if ($deleted_cat) {
        	/*-------alert message using java script-----*/
        	echo '<script type="text/javascript">';
			echo ' alert("Successfully Deleted")';  
			echo '</script>';
        }else{
        	echo "<span style='color:red;font-size:20px'>Data not deleted !!</span>";
        }
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
							$query = "SELECT * FROM table_category";
							$get_category = $db->select($query);
							if ($get_category) {
								$serialNo = 0;
								while ($result = $get_category->fetch_assoc()) {
									$serialNo++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $serialNo;?></td>
							<td><?php echo $result['name'];?></td>
							<td><a href="catlistEdit.php?catid=<?php echo $result['id'];?>">Edit</a> || <a     onclick="return confirm('Are you sure to delete ?')" href="?del_catid=<?php echo $result['id'];?>">Delete</a></td>
						</tr>
						<?php } }?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
 
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>   


 <?php include "inc/footerAdmin.php"?>

