<div class="slidersection templete clear">
        <div id="slider">
        	<?php
        		$query = "SELECT * FROM table_slider order by id desc limit 5";
        		$get_image = $db->select($query);
        		if ($get_image) {
        			while ($result = $get_image->fetch_assoc()) {
        			
        	?>
            <a href="#"><img src="admin/uploadPhoto/sliderPhoto/<?php echo $result['image'];?>" alt="nature 1" title="<?php //echo $result['title'];?>" /></a>
            <?php }}?>
        </div>

</div>

