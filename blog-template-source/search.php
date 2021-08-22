
<?php
	include "inc/header.php";
?>

<?php
	if (!isset($_POST['search']) || $_POST['search']==NULL) {
		echo "<script>window.location='404.php';</script>";
	}
	else{
		$search = $_POST['search'];
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">

		<?php 
			$query = "SELECT * from table_post where title LIKE '%$search%' OR body LIKE '%$search%' ";
			$get_post = $db->select($query);
			if ($get_post) {
				while ($result = $get_post->fetch_assoc()) {

		?>

		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
			<h4><?php echo $fm->myDate($result['date']).' ';?>by <a href="#"><?php echo $result['author'];?></a></h4>
			<a href="#"><img src="admin/uploadPhoto/<?php echo $result['image'];?>" height="100px" width="400px" alt="post image"/></a>
			<?php echo $fm->postShorting($result['body']).'</br>';?>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
			</div>
		</div>

					<?php }?>
			<?php }else{ ?>	
					<span>Search result not found...</span>	
			<?php }?>
	</div>

	
<?php }?>

	<?php include "inc/sidebar.php";?>		
	<?php include "inc/footer.php";?>


