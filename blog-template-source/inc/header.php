
<?php

	include "config/config.php";
	include "lib/Database.php";
	include "helpers/date_format.php";

?>
<?php
	$db = new Database();
	$fm = new DateFormation();
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
		    if (isset($_GET['page_id'])) {
		        $page_id = $_GET['page_id'];

		        $query = "SELECT * FROM table_page WHERE id='$page_id'";
	            $get_page = $db->select($query);
	            if ($get_page) {
	                while ($result_page = $get_page->fetch_assoc()) {
	                	echo $result_page['page_name']." | ".TITLE;
	                }
	            }
		    }elseif (isset($_GET['id'])) {
		    	$post_id = $_GET['id'];

		        $query = "SELECT * FROM table_post WHERE id='$post_id'";
	            $get_post_title = $db->select($query);
	            if ($get_post_title) {
	                while ($result_post_title = $get_post_title->fetch_assoc()) {
	                	echo $result_post_title['title']." | ".TITLE;
	                }
	            }
		    }
		    else{
		        echo $fm->title()." | ".TITLE;
		    }
		?>  		
	</title>

	<?php include "scripts/meta.php";?>
	<?php include "scripts/css_style.php";?>
	<?php include "scripts/javascript.php";?>
	
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<?php 
                    $query = "SELECT * FROM table_slogan WHERE id='1' ";
                    $get_slogan = $db->select($query);
                    if ($get_slogan) {
                        while ($result = $get_slogan->fetch_assoc()) {
                ?>
			<div class="logo">
				<a href="index.php"><img src="admin/uploadPhoto/<?php echo $result['logo'];?>" alt="Logo" style="border-radius: 50%"/></a>
				
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['slogan'];?></p>
			</div>
			<?php } }?>
		</a>
		<div class="social clear">
			<?php
				$query = "SELECT * FROM table_social WHERE id=1";
				$get_social = $db->select($query);
				if ($get_social) {
					while ($result_social = $get_social->fetch_assoc()) {						
			?>
			<div class="icon clear">
				<a href="<?php echo $result_social['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result_social['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result_social['instagram'];?>" target="_blank"><i class="fa fa-instagram"></i></a>
				<a href="<?php echo $result_social['youtube'];?>" target="_blank"><i class="fa fa-youtube"></i></a>
			</div>
			<?php }}?>
			<div class="searchbtn clear">
			<form action="search.php" method="POST">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li>
			<a 
				<?php 
					$path = $_SERVER['SCRIPT_FILENAME'];
					$title_name = basename($path, '.php');
					if ($title_name == 'index') {
						echo 'id="active"';
					}
				?>
				href="index.php">Home
			</a>
		</li>
		
		<?php
            $query = "SELECT * FROM table_page";
            $get_page = $db->select($query);
            if ($get_page) {
                while ($result_page = $get_page->fetch_assoc()) {
                 
        ?>    
            <li>
            	<a 
            	<?php 
            		if (isset($_GET['page_id']) AND $_GET['page_id']==$result_page['id']) {
            			echo 'id="active"';
            		}
            	?>
            	href="page_type.php?page_id=<?php echo $result_page['id'];?>"><?php echo $result_page['page_name'];?>
            		
            	</a>
            </li>
        <?php }}?> 

		<li>
			<a 
				<?php 
					$path = $_SERVER['SCRIPT_FILENAME'];
					$title_name = basename($path, '.php');
					if ($title_name == 'contact') {
						echo 'id="active"';
					}
				?>
				href="contact.php">Contact
			</a>
		</li>
	</ul>
</div>