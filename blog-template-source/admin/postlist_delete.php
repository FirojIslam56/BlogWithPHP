<?php
include "../lib/Session.php";
Session::checkSession();
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

<?php
if (!isset($_GET['delete_post_id']) OR $_GET['delete_post_id']==NULL) {
    header("Location:postlist.php");
}else{
    $delete_post_id = $_GET['delete_post_id'];

    $query = "SELECT * FROM table_post WHERE id='$delete_post_id' ";
    $get_usrid = $db->select($query);
    if ($get_usrid) {
        while ($result = $get_usrid->fetch_assoc()) {
            $usrID = $result['userid'];
                //echo "the user id: ".$usrID;
            if ($usrID != Session::get('userId') AND Session::get('userId')!='1' ) {
                echo "<script>alert('You can not delete this post.')</script>";
                echo "<script>window.location='postlist.php';</script>";
            }else{
               $pic_query = "SELECT * FROM table_post WHERE id='$delete_post_id'";
               $pic_id = $db->select($pic_query);
               if ($pic_id) {
                while ($result_pic = $pic_id->fetch_assoc()) {
                    $deleted_pic = $result_pic['image'];
                    unlink('uploadPhoto/sliderPhoto/'.$deleted_pic);
                }
            }

            $query = "DELETE FROM table_post WHERE id='$delete_post_id' ";
            $deleted_post = $db->delete($query);
            if ($deleted_post) {
                echo "<script>alert('Post Deleted Successfully.');</script>";
                header("Location:postlist.php");
            }else{
                echo "<script>alert('Post not Deleted...')</script>";
                header("Location:postlist.php");
            }
        }
    }
}




}

?>
