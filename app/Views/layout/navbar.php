<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fs-4" href="/">
            <i class="fas fa-clinic-medical text-primary me-2"></i> Mecura
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav gap-4">
                <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
            </ul>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <a href="#" class="text-dark"><i class="fas fa-search fs-5"></i></a>
            
            <a href="/cart" class="text-dark position-relative hover-primary">
                <i class="fas fa-shopping-cart fs-5"></i>
                <?php 
                    $cartCount = 0;
                    if(session()->get('logged_in')) {
                        // Secara dinamis memanggil db untuk menghitung isi keranjang
                        $db = \Config\Database::connect();
                        $cartCount = $db->table('carts')->where('user_id', session()->get('user_id'))->countAllResults();
                    }
                ?>
                <?php if($cartCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                        <?= $cartCount; ?>
                    </span>
                <?php endif; ?>
            </a>

            <?php if(session()->get('logged_in')): ?>
                <div class="dropdown ms-2">
                    <button class="btn btn-sm btn-primary rounded-pill px-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i> <?= esc(session()->get('name')); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 rounded-3">
                        
                        <?php if(session()->get('role') === 'admin'): ?>
                            <li><a class="dropdown-item" href="/admin/medicines"><i class="fas fa-pills me-2 text-primary"></i> Manage Medicines</a></li>
                            <li><hr class="dropdown-divider"></li>
                        <?php endif; ?>
                        
                        <li><a class="dropdown-item" href="#"><i class="fas fa-history me-2 text-secondary"></i> My Orders</a></li>
                        <li><a class="dropdown-item text-danger" href="/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="/login" class="btn btn-sm btn-outline-primary rounded-pill px-3 ms-2">Login</a>
                <a href="/register" class="btn btn-sm btn-primary rounded-pill px-3">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div style="height: 80px;"></div>