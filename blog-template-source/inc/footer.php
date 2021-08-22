</div>

<div class="footersection templete clear">
	<div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	</div>
	<?php
            $query = "SELECT * FROM table_copyright WHERE id=1";
            $get_copyright = $db->select($query);
            if ($get_copyright) {
                while ($result_copyright = $get_copyright->fetch_assoc()) {
             
        ?> 
	<p>&copy; <?php echo $result_copyright['cp_text'];?></p>
	<?php }}?>
</div>

<?php
	$query = "SELECT * FROM table_social WHERE id=1";
	$get_social = $db->select($query);
	if ($get_social) {
		while ($result_social = $get_social->fetch_assoc()) {						
?>
<div class="fixedicon clear">
	<a href="<?php echo $result_social['facebook'];?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
	<a href="<?php echo $result_social['twitter'];?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
	<a href="<?php echo $result_social['instagram'];?>" target="_blank"><img src="images/in-2.png" alt="Instagram"/></a>
	<a href="<?php echo $result_social['youtube'];?>" target="_blank"><img src="images/yt.png" alt="YouTube"/></a>
</div>
<?php }}?>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>