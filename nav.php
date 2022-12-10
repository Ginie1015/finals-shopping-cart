<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link <?php echo($_SESSION['CURR_PAGE'] == 'dashboard' ? 'active': 'text-secondary'); ?>" aria-current="page" href="dashboard.php">
            <span data-feather="home" class="align-text-bottom"></span>
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php echo($_SESSION['CURR_PAGE'] == 'products' ? 'active': 'text-secondary'); ?>" href="products.php">
            <span data-feather="file" class="align-text-bottom"></span>
            <i class="fa-solid fa-cart-shopping"></i> Products
        </a>
        </li>
    </ul>
    </div>
</nav>