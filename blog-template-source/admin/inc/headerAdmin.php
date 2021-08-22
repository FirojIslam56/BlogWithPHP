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

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <?php 
                    $query = "SELECT * FROM table_slogan WHERE id='1' ";
                    $get_slogan = $db->select($query);
                    if ($get_slogan) {
                        while ($result = $get_slogan->fetch_assoc()) {
                ?>
                <div class="floatleft logo">
                    <a href="index.php"><img src="uploadPhoto/<?php echo $result['logo'];?>" alt="Logo" style="border-radius: 50%;"/></a>
                </div>
                <div class="floatleft middle">
                   <h1><?php echo $result['title'];?></h1>
                   <p><?php echo $result['slogan'];?></p>
               </div>
                <?php } }?>
               <div class="floatright">
                <div class="floatleft">
                    <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <?php
                            if (isset($_GET['action']) AND $_GET['action']=='logout') {
                                Session::destroy();
                            }
                        ?>
                        <ul class="inline-ul floatleft">  
                            <li><?php echo Session::get('name');?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-dashboard"><a href="themes.php"><span>Themes</span></a> </li>
                <li class="ic-form-style"><a href="user_profile.php"><span>User Profile</span></a></li>
                <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>

                <?php
                    $query = "SELECT * FROM table_contact WHERE status=0 ";
                    $get_row_number = $db->select($query); 
                    if ($get_row_number) {
                        $total_row = mysqli_num_rows($get_row_number);
                ?>
                <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox<?php echo '('.$total_row.')';?></span></a></li>
            <?php }else{echo "No result found.";}?>

                <li class="ic-charts"><a href="userlist.php"><span>User List</span></a></li>
                <li class="ic-charts"><a href="useradd.php"><span>Add User</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
       