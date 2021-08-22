<?php include "inc/headerAdmin.php"?>
<?php include "inc/sidebarAdmin.php"?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">S. No</th>
                        <th width="15%">Post Title</th>
                        <th width="10%">Image</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM table_slider order by id desc";
                        $get_post = $db->select($query);
                        if ($get_post) {
                            $serialNo = 0;
                            while ($result = $get_post->fetch_assoc()) {
                                $serialNo++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $serialNo?></td>
                        <td><?php echo $result['title'];?></td>
                        <td><img src="uploadPhoto/sliderPhoto/<?php echo $result['image'];?>" height="50px" width="80px" alt="post image"/></td>
                        <td>
                            <?php
                                $table_user_id = Session::get('userId');
                                if ($table_user_id=='1') {
                            ?>
                            <a href="slider_edit.php?edit_slider_id=<?php echo $result['id'];?>">Edit</a>||
                            <a onclick="return confirm('Are you sure to delete?')" href="slider_delete.php?del_slider_id=<?php echo $result['id'];?>">Delete</a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include "inc/footerAdmin.php"?>