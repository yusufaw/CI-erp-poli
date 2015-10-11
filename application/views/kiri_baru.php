<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                           <img src="<?php echo base_url(); ?>application/views/img/pegawai/<?php echo $foto ?>" class="img-circle" alt="User Image" />
                          </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $nama_pegawai?></p>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="hidden-md">
                            <a href="<?php echo base_url().$link_kiribaru1; ?>">
                                <i class="fa fa-suitcase"></i> <span><?php echo $menu_kiribaru1; ?></span>
                            </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url().$link_kiribaru2; ?>">
                                <i class="fa fa-suitcase"></i> <span><?php echo $menu_kiribaru2; ?></span>
                            </a>
                        </li>
						<li >
                            <a href="<?php echo base_url().$link_kiribaru3; ?>">
                                <i class="fa fa-suitcase"></i> <span><?php echo $menu_kiribaru3; ?></span>
                            </a>
                        </li>
						<li >
                            <a href="<?php echo base_url().$link_kiribaru4; ?>">
                                <i class="fa fa-suitcase"></i> <span><?php echo $menu_kiribaru4; ?></span>
                            </a>
                        </li>
						
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    	<small>Admin</small> 
                        <?php echo $nama_modul; ?>
                                           </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $nama_modul ?></li>
                    </ol>
                </section>