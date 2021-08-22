<?php
    include "../lib/Session.php";
    Session::checkSession();
?>

<?php
    include "../config/config.php";
    include "../lib/Database.php";
?>
<?php
    $db = new Database();
?>

<?php
    if (!isset($_GET['delid']) OR $_GET['delid']==NULL) {
        header("Location:index.php");
    }else{
        $delid = $_GET['delid'];
        $query = "DELETE FROM table_page WHERE id='$delid' ";
        $deleted_page = $db->delete($query);
        if ($deleted_page) {
        	echo "<script>alert('Page Deleted Successfully.');</script>";
        	header("Location:index.php");
        }else{
        	echo "<script>alert('Page not Deleted...')</script>";
        	header("Location:index.php");
        }
       
    }
?>
