<!-- header area start -->
<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="search-box pull-left">
                <form action="#">
                    <input type="text" name="search" placeholder="Search..." required>
                    <i class="ti-search"></i>
                </form>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb" src="../siete.png" alt="avatar">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']; ?> <i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">  
                    <a class="dropdown-item" href="/pages/settings.php">Settings</a>
                    <a class="dropdown-item" href="index.php?logout='1'">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- header area end -->
<!-- page title area start -->
<?#php if ($_SERVER['REQUEST_URI'] == "/") { ?>
<div class="page-title-area mb-4">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">
                    <?php echo isset($title_text) ? "<h1>" . htmlspecialchars($title_text) . "</h1>" : "<h1>Title Here!</h1>"; ?>
                </h4>
                <?php 
                    $visible = isset($isBreadcrumbsOn) ? $isBreadcrumbsOn : TRUE;
                if($visible) { ?>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Item Records</a></li>
                    <li><a href="#">Reports</a></li>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?#php } ?>
<!-- page title area end -->
