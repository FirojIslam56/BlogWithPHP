<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">  
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">S. No</th>
						<th width="5%">Category</th>
						<th width="15%">Post Title</th>
						<th width="20%">Description</th>
						<th width="10%">Image</th>
						<th width="10%">Author</th>
						<th width="10%">Tags</th>
						<th width="10%">Date</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = "SELECT table_post.*, table_category.name FROM table_post INNER JOIN table_category ON table_post.category = table_category.id order by id desc";
						$get_post = $db->select($query);
						if ($get_post) {
							$serialNo = 0;
							while ($result = $get_post->fetch_assoc()) {
								$serialNo++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $serialNo?></td>
						<td><?php echo $result['name'];?></td>
						<td><?php echo $result['title'];?></td>
						<td><?php echo $fm->postShorting($result['body'],50)?></td>
						<td><img src="uploadPhoto/<?php echo $result['image'];?>" height="50px" width="80px" alt="post image"/></td>
						<td><?php echo $result['author'];?></td>
						<td><?php echo $result['tags'];?></td>
						<td><?php echo $fm->myDate($result['date'])?></td>
						<td>
							<a href="postlist_view.php?view_post_id=<?php echo $result['id'];?>">View</a>
							<?php
								$table_user_role = Session::get('userRole');
								$table_user_id = Session::get('userId');
								$table_post_id = $result['userid'];
								if ($table_user_id==$table_post_id OR $table_user_role=='1') {
							?>
							||<a href="postlist_edit.php?edit_post_id=<?php echo $result['id'];?>">Edit</a>||
							<a onclick="return confirm('Are you sure to delete?')" href="postlist_delete.php?delete_post_id=<?php echo $result['id'];?>">Delete</a>
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