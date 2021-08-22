<?php
	include "../lib/Session.php";
	//Session::init();
	Session::checkLogin();
?>
<?php
	include "../config/config.php";
	include "../lib/Database.php";
	include "../helpers/date_format.php";
?>
<?php
	$db = new Database();
	$fm = new DateFormation();
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$username = $_POST['username'];
				$password = md5($_POST['password']);
				
				$username = $fm->adminLoginValidation($username) ;
				$password = $fm->adminLoginValidation($password) ;

				$username = mysqli_real_escape_string($db->link, $username);
				$password = mysqli_real_escape_string($db->link, $password);

				$query = "SELECT * FROM table_user WHERE username='$username' AND password='$password' ";
				$result = $db->select($query);
				if ($result != false) {
					$get_value = mysqli_fetch_array($result);
					$row = mysqli_num_rows($result);

					if ($row > 0) {
						Session::set('login',true);
						Session::set('name',$get_value['name']);
						Session::set('username',$get_value['username']);
						Session::set('userId',$get_value['id']);
						Session::set('userRole',$get_value['role']);
						header("Location:index.php");
					}else{
						echo "<span style='color:red;font-size:20px;'> No result found !! </span>";
					}
				}else{
					echo "<span style='color:red;font-size:20px;'> Username and Password not matched !! </span>";
				}
			}

		?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Blog with FM</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>