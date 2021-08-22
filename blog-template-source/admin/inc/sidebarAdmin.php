 <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                     <li><a class="menuitem">Site Option</a>
                        <ul class="submenu">
                            <li><a href="titleslogan.php">Title & Slogan</a></li>
                            <li><a href="social.php">Social Media</a></li>
                            <li><a href="copyright.php">Copyright</a></li>
                            
                        </ul>
                    </li>
                    
                    <li><a class="menuitem">Pages</a>
                        <ul class="submenu">
                            <li><a href="addpage.php">Add Page</a></li>
                        <?php
                            $query = "SELECT * FROM table_page";
                            $get_page = $db->select($query);
                            if ($get_page) {
                                while ($result_page = $get_page->fetch_assoc()) {
                                 
                        ?>    
                            <li><a href="page_type.php?page_id=<?php echo $result_page['id'];?>"><?php echo $result_page['page_name'];?></a></li>
                        <?php }}?>    
                        </ul>
                    
                    </li>
                    <li><a class="menuitem">Category</a>
                        <ul class="submenu">
                            <li><a href="addcat.php">Add Category</a> </li>
                            <li><a href="catlist.php">Category List</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Slider</a>
                        <ul class="submenu">
                            <li><a href="slider_add.php">Add Slider</a> </li>
                            <li><a href="slider_list.php">Slider List</a> </li>
                        </ul>
                    </li>
                    <li><a class="menuitem">Posts</a>
                        <ul class="submenu">
                            <li><a href="addpost.php">Add Post</a> </li>
                            <li><a href="postlist.php">Post List</a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>