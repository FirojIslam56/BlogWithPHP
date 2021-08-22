<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>
		<ul>
			<?php 
				$query = "SELECT * FROM table_category order by id desc limit 10 ";
				$get_category = $db->select($query);
				if ($get_category) {
					while ($cat_result=$get_category->fetch_assoc()) {
						//echo "category name is: ".$cat_result['name'];
			?>

			<li><a href="more_post.php?category=<?php echo $cat_result['id'];?>"><?php echo $cat_result['name'];?></a></li>

			<?php } }?>
					
		</ul>
	</div>
	
	<div class="samesidebar clear">
		<h2>Latest articles</h2>
		<?php 
			$query = "SELECT * from table_post order by id desc limit 4 ";
			$get_post = $db->select($query);
			if ($get_post) {
				while ($result = $get_post->fetch_assoc()) {
		?>



		<div class="popular clear">
			<h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
			<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/uploadPhoto/<?php echo $result['image'];?>" height="100px" width="400px" alt="post image"/></a>
			<?php echo $fm->postShorting($result['body'],80).'</br>';?>
		</div>
		
		<?php }?>

	<?php }?>
		
	</div>
	
</div>