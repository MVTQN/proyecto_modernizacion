
<div class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <!-- MENU -- NAME -->
    <div class="app-header__logo">
        <div class="logo-src" style="color: white;">
            <h1>Sysadmin</h1>
        </div>
        
    </div>

    <!-- HEADER CONTENT -->
    <div class="app-header__content"  style="width:100%">
    <div style="display: inline-block; text-align: right; width: 100%">
        <div class="app-header-right" style="display: inline-block; text-align: right; width: 100%">
            <div class="header-btn-lg pr-0" style="display: inline-block; text-align: right; width: 100%">
                <div class="widget-content p-0" style="display: inline-block; text-align: right; width: 100%">
                    <div class="widget-content-wrapper" style="display: inline-block; text-align: right; width: 100%">
                        <!-- MENU profile -->
                        <div class="widget-content-left" style="display: inline-block; text-align: right; width: 100%">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    </i> <a type="button" tabindex="0" class="dropdown-item" class="nav-link" data-toggle="modal" data-target="#exampleModal" href="<?php echo WEB_ROOT; ?>/logout.php"> Logout</a>
                                </div>
                            </div>
                        </div>
                        <!-- Profile Info -->
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                                <?php echo $_SESSION['EMPNAME']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        </div>
    </div>
</div>
