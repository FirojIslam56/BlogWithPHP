<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="pagination_style.css">

<?php
$query = "SELECT * FROM table_themes WHERE id='1' ";
$get_themes = $db->select($query);
if ($get_themes) {
	while ( $result = $get_themes->fetch_assoc()) {
		$selected_themes = $result['themes'];
		if ($selected_themes == 'default') {
			?> 
			<link rel="stylesheet" href="theme/default.css">

		<?php }elseif ($selected_themes == 'green') {
			?>
			<link rel="stylesheet" href="theme/green.css">
		<?php } } }?>	
