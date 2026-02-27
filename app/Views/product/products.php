<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
All Products
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container my-5">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none"
                    style="color: var(--primary-color);">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card card-shadow rounded-xl p-4 border-0">
                <h5 class="fw-bold mb-3">Categories</h5>
                <ul class="list-unstyled mb-4">
                    
                    <li class="mb-2">
                        <a href="/products" class="text-decoration-none <?= empty($active_category) ? 'fw-bold text-primary' : 'text-muted hover-primary' ?>">
                            <i class="fas fa-th-large me-2"></i> All Medicines
                        </a>
                    </li>

                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                        <li class="mb-2">
                            <a href="/products?category=<?= $cat['id']; ?>"
                               class="text-decoration-none <?= ($active_category == $cat['id']) ? 'fw-bold text-primary' : 'text-muted hover-primary' ?>">
                               <i class="fas fa-caret-right me-1 <?= ($active_category == $cat['id']) ? '' : 'text-transparent' ?>"></i> <?= esc($cat['name']) ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-muted small">No categories available.</li>
                    <?php endif; ?> 
                </ul>
            </div>
        </div>

        <div class="col-lg-9 col-md-8">
        
        <?php 
                $judulKategori = 'All Medicines';
                
                if (!empty($active_category) && !empty($categories)) {
                    foreach ($categories as $cat) {
                        if ($cat['id'] == $active_category) {
                            $judulKategori = $cat['name'];
                            break;
                        }
                    }
                }
            ?>
            
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <h3 class="section-title mb-0"><?= esc($judulKategori); ?></h3>
                
                <form action="" method="get" class="m-0">
                    
                    <?php if (!empty($active_category)): ?>
                        <input type="hidden" name="category" value="<?= esc($active_category); ?>">
                    <?php endif; ?>
                    
                    <select name="sort" class="form-select w-auto rounded-pill border-0 shadow-sm mt-3 mt-md-0" onchange="this.form.submit()">
                        <option value="">Sort by: Latest</option>
                        <option value="price_asc" <?= (isset($active_sort) && $active_sort == 'price_asc') ? 'selected' : ''; ?>>Price: Low to High</option>
                        <option value="price_desc" <?= (isset($active_sort) && $active_sort == 'price_desc') ? 'selected' : ''; ?>>Price: High to Low</option>
                    </select>
                </form>
                </div>

            <div class="row g-4">
                <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-shadow rounded-xl h-100 border-0 transition-hover">
                        <div class="card-body p-4 text-center position-relative">

                            <button
                                class="btn btn-sm position-absolute top-0 end-0 mt-2 me-2 text-danger border-0 bg-transparent">
                                <i class="far fa-heart fs-5"></i>
                            </button>

                            <a href="/product/<?= $product['id']; ?>" class="d-block">
                                <?php if(!empty($product['image_url'])): ?>
                                <img src="/uploads/medicines/<?= esc($product['image_url']) ?>"
                                    class="img-fluid mb-3 rounded" alt="<?= esc($product['name']) ?>"
                                    style="height: 180px; width: 100%; object-fit: cover;">
                                <?php else: ?>
                                <img src="https://placehold.co/300x300/e9ecef/adb5bd?text=No+Image"
                                    class="img-fluid mb-3 rounded" alt="<?= esc($product['name']) ?>"
                                    style="height: 180px; width: 100%; object-fit: cover;">
                                <?php endif; ?>
                            </a>

                            <p class="text-muted small mb-1 text-start">
                                <?= esc($product['category_name'] ?? 'Uncategorized') ?>
                            </p>

                            <h6 class="fw-bold text-start text-truncate">
                                <a href="/product/<?= $product['id']; ?>"
                                    class="text-decoration-none text-dark hover-primary">
                                    <?= esc($product['name']) ?>
                                </a>
                            </h6>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="fw-bold mb-0" style="color: var(--primary-color);">
                                    Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                </h5>

                                <form action="/cart/add" method="post" class="m-0">
                                    <input type="hidden" name="id" value="<?= $product['id']; ?>">
                                    <input type="hidden" name="qty" value="1">

                                    <?php if (! session('logged_in')): ?>
                                    <a href="/login" class="btn btn-outline-primary rounded-pill px-3 btn-sm">
                                        Login to add
                                    </a>
                                    <?php else: ?>
                                    <button type="submit" class="btn btn-primary-soft rounded-pill px-3 btn-sm"
                                        <?= $product['stock'] < 1 ? 'disabled' : ''; ?>>
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No products available at the moment.</p>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?= $this->section('extra-css'); ?>
<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .hover-primary:hover {
        color: var(--primary-color) !important;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>