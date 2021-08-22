<?php
	include "inc/header.php";
?>

<?php
    if (!isset($_GET['page_id']) OR $_GET['page_id']==NULL) {
        header("Location:404.php");
    }else{
        $page_id = $_GET['page_id'];
        //echo "string".$page_id;
    }
?>
    
<div class="contentsection contemplete clear">
<?php
            $query = "SELECT * FROM table_page WHERE id='$page_id' ";
            $get_page_type = $db->select($query); 
            if ($get_page_type) {
                while ($result_page_type = $get_page_type->fetch_assoc()) {
                 
        ?> 
	<div class="maincontent clear">
		<div class="about">
			<h2><?php echo $result_page_type['page_name'];?></h2>
			<p><?php echo $result_page_type['page_body'];?></p>
			
		</div>
	</div>

<?php }}?> 

	<?php include "inc/sidebar.php";?>
	<?php include "inc/footer.php";?>
