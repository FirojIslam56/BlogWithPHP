<?php
	include "inc/header.php";
?>
<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') {	
		$firstname = $fm->adminLoginValidation($_POST['firstname']);
		$lastname = $fm->adminLoginValidation($_POST['lastname']);
		$email = $fm->adminLoginValidation($_POST['email']);
		$body = $fm->adminLoginValidation($_POST['body']);

		$firstname = mysqli_real_escape_string($db->link, $firstname);
		$lastname = mysqli_real_escape_string($db->link, $lastname);
		$email = mysqli_real_escape_string($db->link, $email);
		$body = mysqli_real_escape_string($db->link, $body);

		$error='';
		$msg='';

		if ($firstname=='' OR $lastname=='' OR $email=='' OR $body=='') {
			$error="Filled must not be empty !!";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error="Invalid email !!";
		}else{
			$query = "INSERT INTO table_contact(firstname,lastname,email,body) VALUES('$firstname','$lastname','$email','$body')";
                    $inserted_content = $db->insert($query);
                    if ($inserted_content) {
                        $msg="Message sent successful.";
                    }else{
                        $error="Message send failed !!";
                    }
		}
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if (isset($error)) {
						echo "<span style='color:red'>$error</span>";
					}
					if (isset($msg)) {
						echo "<span style='color:green'>$msg</span>";
					}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
	<?php include "inc/sidebar.php";?>
	<?php include "inc/footer.php";?>