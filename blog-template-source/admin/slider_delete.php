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
?>

<?php
if (!isset($_GET['del_slider_id']) OR $_GET['del_slider_id']==NULL) {
    echo "<script>window.location='slider_list.php';</script>";
}else{
    $del_slider_id = $_GET['del_slider_id'];

    $query = "SELECT * FROM table_slider WHERE id='$del_slider_id' ";
    $get_sldrid = $db->select($query);
    if ($get_sldrid) {
        while ($result = $get_sldrid->fetch_assoc()) {
            if (Session::get('userId')!='1' ) {
                echo "<script>alert('Only admin can delete slider.')</script>";
                echo "<script>window.location='slider_list.php';</script>";
            }else{
               $pic_query = "SELECT * FROM table_slider WHERE id='$del_slider_id'";
               $pic_id = $db->select($pic_query);
               if ($pic_id) {
                while ($result_pic = $pic_id->fetch_assoc()) {
                    $deleted_pic = $result_pic['image'];
                    unlink('uploadPhoto/sliderPhoto/'.$deleted_pic);
                    }
                }

            $query = "DELETE FROM table_slider WHERE id='$del_slider_id' ";
            $deleted_sldr = $db->delete($query);
            if ($deleted_sldr) {
                echo "<script>alert('Slider Deleted Successfully.');</script>";
                echo "<script>window.location='slider_list.php';</script>";
            }else{
                echo "<script>alert('Slider not Deleted...')</script>";
                echo "<script>window.location='slider_list.php';</script>";
            }
        }
    }
}




}

?>
