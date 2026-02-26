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
                    <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                    <li class="mb-2"><a href="#"
                            class="text-decoration-none text-muted hover-primary"><?= esc($cat['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p class="text-muted">No categories available.</p>
                <?php endif; ?>
                <h5 class="fw-bold mb-3 mt-4">Price Range</h5>
                <input type="range" class="form-range mb-2" id="priceRange">
                <div class="d-flex justify-content-between text-muted small">
                    <span>Rp 0</span>
                    <span>Rp 500.000+</span>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-8">

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <h3 class="section-title mb-0">All Medicines</h3>
                <select class="form-select w-auto rounded-pill border-0 shadow-sm mt-3 mt-md-0">
                    <option>Sort by: Popularity</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
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

                            <img src="<?= esc($product['image_url'] ?? 'https://placehold.co/150x150/png?text=Medicine') ?>"
                                class="img-fluid mb-3 rounded" alt="<?= esc($product['name']) ?>">

                            <p class="text-muted small mb-1 text-start">
                                <?= esc($product['category_name'] ?? 'Uncategorized') ?>
                            </p>

                            <h6 class="fw-bold text-start text-truncate">
                                <?= esc($product['name']) ?>
                            </h6>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="fw-bold mb-0" style="color: var(--primary-color);">
                                    Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                </h5>
                                <button class="btn btn-primary-soft rounded-pill px-3 btn-sm">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p class="text-muted">No products available.</p>
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