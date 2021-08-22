<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
    if (isset($_GET['del_user'])) {
        $del_user = $_GET['del_user'];
        $query = "DELETE FROM table_user WHERE id='$del_user' ";
        $deleted_user = $db->delete($query);
        if ($deleted_user) {
        	/*-------alert message using java script-----*/
        	echo '<script type="text/javascript">';
			echo ' alert("User Successfully Deleted")';  
			echo '</script>';
        }else{
        	echo "<span style='color:red;font-size:20px'>User not deleted !!</span>";
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
							<th width="5%">S. No</th>
							<th width="20%">Name</th>
							<th width="15%">Username</th>
                            <th width="20%">Email</th>
                            <th width="20%">Details</th>
                            <th width="10%">Role</th>
                            <th width="10%">Action</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
							$query = "SELECT * FROM table_user";
							$get_alluser = $db->select($query);
							if ($get_alluser) {
								$serialNo = 0;
								while ($result_alluser = $get_alluser->fetch_assoc()) {
									$serialNo++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $serialNo;?></td>
							<td><?php echo $result_alluser['name'];?></td>
                            <td><?php echo $result_alluser['username'];?></td>
                            <td><?php echo $result_alluser['email'];?></td>
                            <td><?php echo $fm->postShorting($result_alluser['details'],30);?></td>
                            <td>
                                <?php 
                                    $rl = $result_alluser['role'];
                                    if ($rl==1) {
                                        echo "Admin";
                                    }elseif ($rl==2) {
                                        echo "Author";
                                    }elseif ($rl==3) {
                                        echo "Editor";
                                    }else{
                                        echo "Error...";
                                    }
                                ?>       
                            </td>

							<td>
                                <a href="userview.php?userview_id=<?php echo $result_alluser['id'];?>">View</a>
                                <?php
                                    if (Session::get('userRole')==1) {
                                ?>
                                || 
                                <a onclick="return confirm('Are you sure to delete ?')" href="?del_user=<?php echo $result_alluser['id'];?>">Delete</a>
                                <?php }?>
                            </td>
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

