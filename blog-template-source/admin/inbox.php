<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>

<?php
	if (isset($_GET['seen_id'])) {
		$seen_id = $_GET['seen_id'];

        $query_update = "UPDATE table_contact
	        SET
	        status    = 1
	        WHERE id='$seen_id'
	        ";
	        $updated_status = $db->update($query_update);
	        if ($updated_status) {
	            echo "<span style='color:white;font-size:20px;'> Message move to seen-box. </span>";
	        }else{
	            echo "<span style='color:red;font-size:20px;'>Error ! Message not move to seen-box.. </span>";
	        }
    }
?>
<?php
	if (isset($_GET['unseen_id'])) {
		$unseen_id = $_GET['unseen_id'];

        $query_update = "UPDATE table_contact
	        SET
	        status    = 0
	        WHERE id='$unseen_id'
	        ";
	        $updated_status = $db->update($query_update);
	        if ($updated_status) {
	            echo "<span style='color:white;font-size:20px;'> Message Move to inbox . </span>";
	        }else{
	            echo "<span style='color:red;font-size:20px;'Error ! Message not move to inbox. </span>";
	        }
    }
?>
<?php
    if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];
        $query = "DELETE FROM table_contact WHERE id='$del_id' ";
        $deleted_page = $db->delete($query);
        if ($deleted_page) {
        	echo "<span style='color:white;font-size:20px;'> Message deleted. </span>";
        }else{
        	echo "<span style='color:white;font-size:20px;'> Message not delete. </span>";
        }
       
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="10%">Serial No.</th>
							<th width="15%">Name</th>
							<th width="20%">Email</th>
							<th width="20%">Message</th>
							<th width="20%">Date</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
				            $query = "SELECT * FROM table_contact WHERE status=0 order by id desc ";
				            $get_contact = $db->select($query); 
				    		$count=0;
				            if ($get_contact) {
				                while ($result_contact = $get_contact->fetch_assoc()) {
				                 $count++;
        				?>
						<tr class="odd gradeX">
							<td><?php echo $count;?></td>
							<td><?php echo $result_contact['firstname'].' '.$result_contact['lastname'];?></td>
							<td><?php echo $result_contact['email'];?></td>
							<td><?php echo $fm->postShorting($result_contact['body'],40);?></td>
							<td><?php echo $fm->myDate($result_contact['date']);?></td>

							<td>
								<a href="inbox_viewmsg.php?view_id=<?php echo $result_contact['id'];?>">View</a> || 
								<a href="inbox_replymsg.php?reply_id=<?php echo $result_contact['id'];?>">Reply</a>|| 
								<a href="?seen_id=<?php echo $result_contact['id'];?>">Seen</a>
							</td>
						</tr>
					<?php } }?>	
					</tbody>
				</table>
               </div>
            </div>

             <div class="box round first grid">
                <h2>Seen Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="10%">Serial No.</th>
							<th width="15%">Name</th>
							<th width="17%">Email</th>
							<th width="20%">Message</th>
							<th width="20%">Date</th>
							<th width="18%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
				            $query = "SELECT * FROM table_contact WHERE status=1 order by id desc ";
				            $get_contact = $db->select($query); 
				    		$count=0;
				            if ($get_contact) {
				                while ($result_contact = $get_contact->fetch_assoc()) {
				                 $count++;
        				?>
						<tr class="odd gradeX">
							<td><?php echo $count;?></td>
							<td><?php echo $result_contact['firstname'].' '.$result_contact['lastname'];?></td>
							<td><?php echo $result_contact['email'];?></td>
							<td><?php echo $fm->postShorting($result_contact['body'],40);?></td>
							<td><?php echo $fm->myDate($result_contact['date']);?></td>

							<td>
								<a href="inbox_viewmsg.php?view_id=<?php echo $result_contact['id'];?>">View</a> ||
								<a href="?unseen_id=<?php echo $result_contact['id'];?>">UnSeen</a> ||
								<a onclick="return confirm('Are you sure to delete ?')" href="?del_id=<?php echo $result_contact['id'];?>">Delete</a>
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
