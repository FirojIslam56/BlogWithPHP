<?php
	include "inc/header.php";
?>

<?php
	if (!isset($_GET['id']) || $_GET['id']==NULL) {
		header("Location:404.php");
	}
	else{
		$id = $_GET['id'];
		//echo "your id is: ".$id;
		$query = "SELECT * from table_post where id=$id";
		$get_post_all = $db->select($query);
		if ($get_post_all) {
			while ($result = $get_post_all->fetch_assoc()) {	
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">				
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
				<h4><?php echo $fm->myDate($result['date']).' ';?>by <a href="#"><?php echo $result['author'];?></a></h4>
				<a href="#"><img src="admin/uploadPhoto/<?php echo $result['image'];?>" height="100px" width="400px" alt="post image"/></a>
				<?php echo $result['body'];?>

				<div class="relatedpost clear">
					<h2>Related articles</h2>

				<?php
					$category_id = $result['category'];
					//echo "string".$category_id;
					$query_cat = "SELECT * FROM table_post where category=$category_id";
					$related_post = $db->select($query_cat);
					if ($related_post) {
						while ( $result_related_post = $related_post->fetch_assoc()) {

				?>	
					<a href="post.php?id=<?php echo $result_related_post['id'];?>"><img src="admin/uploadPhoto/<?php echo $result_related_post['image'];?>" height="100px" width="400px" alt="post image"/></a>

					<?php } }?>

				</div>

				<?php }?>

		<?php } else{ header("Location:404.php"); }?>
				
			</div>
<?php }?>
		</div>
		<?php include "inc/sidebar.php";?>
		<?php include "inc/footer.php";?>
	