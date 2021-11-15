        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-code"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Administrator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">


           <!-- query dari menu -->
           <?php 

            $role_id = $this->session->userdata('role_id');
            $queryMenu = "
                           SELECT `user_menu`.`id`, `menu`
                             FROM `user_menu` JOIN `user_access_menu`
                               ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC
                         ";

            $menu = $this->db->query($queryMenu)->result_array();
            ?>


            <!-- Heading -->
            <?php foreach($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu'] ?>
            </div>

            <!-- query submenu -->
            <?php
            
            $menuId = $m['id'];
            $querySubmenu = "
                            SELECT *
                             FROM `user_sub_menu` JOIN `user_menu`
                               ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                            WHERE `user_sub_menu`.`menu_id` = $menuId
                            AND `user_sub_menu`.`is_active` = 1
            ";

            $submenu = $this->db->query($querySubmenu)->result_array();
               
            ?>
                <!-- looping submenu -->
                <?php foreach($submenu as $sm) : ?>
                     <!-- Nav Item - Dashboard -->
                   <li class="nav-item">
                       <a class="nav-link" href="<?= $sm['url']; ?>">
                          <i class="<?= $sm['icon']; ?>"></i>
                          <span><?= $sm['title']; ?></span>
                       </a>
                   </li>
                <?php endforeach; ?>

               <!-- Divider -->
              <hr class="sidebar-divider d-none d-md-block">

            <?php endforeach; ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->