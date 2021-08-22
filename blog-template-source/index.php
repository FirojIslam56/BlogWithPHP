
<?php
	include "inc/header.php";
	include "inc/slider.php";
?>


<div class="contentsection contemplete clear">
	<div class="maincontent clear">

	<?php
		$lim = 3;
		if (isset($_GET['page'])) {
			$page_number = $_GET['page'];
		}
		else{
			$page_number = 1;
		}

		

		$offset = ($page_number-1)*$lim;
		

		$query = "SELECT * FROM table_post order by id desc limit {$offset}, {$lim}";
		$get_post = $db->select($query);
		if ($get_post) {
			while ( $result = $get_post->fetch_assoc()) {
				
				
	?>	

		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
			<h4><?php echo $fm->myDate($result['date']).' ';?>by <a href="#"><?php echo $result['author'];?></a></h4>
			<a href="#"><img src="admin/uploadPhoto/<?php echo $result['image'];?>" height="100px" width="400px" alt="post image"/></a>
			<?php echo $fm->postShorting($result['body'],320).'</br>';?>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
			</div>
		</div>
					<?php } ?>
	<?php } else{
		header("Location:post.php");
	}?>
	</div>


	<?php include "inc/sidebar.php";?>


	<?php
		
		$query = "SELECT * FROM table_post";
		$get_row = $db->select($query);
		if (mysqli_num_rows($get_row)) {
			$total_row = mysqli_num_rows($get_row);
			$total_page = ceil($total_row/$lim);

			echo '<ul class="pagination">';
			if ($page_number>1) {
					echo '<li><a href="index.php?page='.($page_number-1).'">Prev</a></li>';
				}

			for ($i=1; $i<=$total_page ; $i++){
				if ($i==$page_number) {
					$activeBG = "green";
				}
				else{
					$activeBG = " ";
				}
				echo '<li style="background:'.$activeBG.'"><a href="index.php?page='.$i.'">'.$i.'</a></li>';	
			}
			if ($page_number<$total_page) {
				echo '<li><a href="index.php?page='.($page_number+1).'">Next</a></li>';
			}

			echo '</ul>';
		}
	?>
		
		
	
	

	<?php include "inc/footer.php";?>


		
	