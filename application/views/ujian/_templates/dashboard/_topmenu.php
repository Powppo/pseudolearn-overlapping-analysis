<a href="<?=base_url('dashboard')?>" class="logo">
    <span class="logo-mini"><b>CBT</b></span>
    <!-- <span class="logo-lg"><b>JPLAS </span> -->
</a>

<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-right: 15px; margin-top: 10px; background: white; border-radius: 10px; width: 12rem;  box-shadow: -1px 4px 5px 0px rgba(0,0,0,0.31);
                    -webkit-box-shadow: -1px 4px 5px 0px rgba(0,0,0,0.31);
                    -moz-box-shadow: -1px 4px 5px 0px rgba(0,0,0,0.31);">
                    <!-- The user image in the navbar-->
                    <img src="<?=base_url()?>assets/dist/img/shutdown.png" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span>Logout</span>
                </a>
                <ul class="dropdown-menu" style="margin-right: 10px; margin-top: 10px;">
                    <!-- The user image in the menu -->
                    <li class="user-header" style="background: white;">
                        <img src="<?=base_url()?>assets/dist/img/cat.png" class="img-circle" alt="User Image"> 
                        <p class="text-bold">
                            <?=$user->first_name?> <?=$user->last_name?> 
                            <small><?=$user->username?></small>
                        </p> 
                    </li> 
                    <!-- Menu Body -->
                    <li class="user-footer" style="background: #CBBCB1;">
                        <!-- <div class="pull-left">
                            <a href="<?=base_url()?>users/edit/<?=$user->id?>" class="btn btn-default btn-flat">
                                <?=$this->ion_auth->is_admin() ? "Edit Profile" : "Ganti Password" ?>
                            </a>
                        </div> -->
                        <div class="pull-right">
                            <a href="#" id="logout" class="btn btn-default btn-flat text-bold">Logout</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>