<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('extra-css'); ?>
<style>
    .hero-section {
        background: linear-gradient(135deg, #eadaff 0%, #f3f0ff 100%);
        border-radius: 30px;
        overflow: hidden;
        margin-top: 20px;
    }
    .category-circle {
        width: 80px; height: 80px; background: #fff; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    .category-circle:hover { transform: translateY(-5px); }
    .transition-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
    .hover-primary:hover { color: var(--primary-color) !important; }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container mb-5">
    
    <section class="hero-section p-5 mb-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="badge bg-white text-primary mb-3 rounded-pill px-3 py-2 shadow-sm">Introducing Mecura</span>
                <h1 class="display-4 fw-bold mb-4" style="color: var(--primary-color);">Your Online <br> Pharmacy Marketplace</h1>
                <p class="lead text-muted mb-4">Find medicines, vitamins, and health products from trusted sellers delivered to you safely.</p>
                <a href="/products" class="btn btn-primary rounded-pill px-4 py-2 me-2 shadow-sm">Shop Now <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
            <div class="col-md-6 text-end d-none d-md-block p-4">
                <img src="<?= base_url('uploads/doctor/Friendly_and_Professional_Male_Doctor_png_images-PNGLove.com.png') ?>" alt="Pharmacy Doctor" class="img-fluid rounded-xl shadow" style="max-height: 400px; width: auto;">
            </div>
        </div>
    </section>

    <section class="mb-5 text-center">
        <h3 class="fw-bold mb-4 text-dark">Our Popular Categories</h3>
        <div class="row justify-content-center g-4">
            <?php if(!empty($categories)): ?>
                <?php foreach($categories as $cat): ?>
                <div class="col-6 col-md-2">
                    <a href="/products?category=<?= $cat['id']; ?>" class="text-decoration-none text-dark hover-primary">
                        <div class="category-circle text-primary">
                            <i class="fas fa-pills fa-2x"></i>
                        </div>
                        <h6 class="fw-bold mt-3"><?= esc($cat['name']); ?></h6>
                    </a>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">No categories found.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="mb-5" id="todays-offer">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0 text-dark">Today's Best Offer</h3>
                <p class="text-muted mb-0">Just For You</p>
            </div>
            <a href="/products" class="btn btn-outline-primary rounded-pill px-4">See all <i class="fas fa-arrow-right ms-1"></i></a>
        </div>

        <div class="row g-4">
            <?php if(!empty($products)): ?>
                <?php foreach($products as $product): ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card card-shadow rounded-xl h-100 border-0 transition-hover">
                        <div class="card-body p-4 text-center position-relative">
                            
                            <button class="btn btn-sm position-absolute top-0 end-0 mt-2 me-2 text-danger border-0 bg-transparent">
                                <i class="far fa-heart fs-5"></i>
                            </button>

                            <a href="/product/<?= $product['id']; ?>" class="d-block">
                                <?php if(!empty($product['image_url'])): ?>
                                    <img src="/uploads/medicines/<?= esc($product['image_url']) ?>" class="img-fluid mb-3 rounded" alt="<?= esc($product['name']) ?>" style="height: 150px; width: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <img src="https://placehold.co/150x150/e9ecef/adb5bd?text=No+Image" class="img-fluid mb-3 rounded" alt="<?= esc($product['name']) ?>" style="height: 150px; width: 100%; object-fit: cover;">
                                <?php endif; ?>
                            </a>

                            <p class="text-muted small mb-1 text-start"><?= esc($product['category_name'] ?? 'Uncategorized') ?></p>

                            <h6 class="fw-bold text-start text-truncate">
                                <a href="/product/<?= $product['id']; ?>" class="text-decoration-none text-dark hover-primary">
                                    <?= esc($product['name']) ?>
                                </a>
                            </h6>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="fw-bold mb-0" style="color: var(--primary-color);">Rp <?= number_format($product['price'], 0, ',', '.') ?></h5>
                                
                                <form action="/cart/add" method="post">
                                    <input type="hidden" name="id" value="<?= $product['id']; ?>">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn btn-primary-soft rounded-pill px-3 btn-sm" <?= $product['stock'] < 1 ? 'disabled' : ''; ?>>
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-4">
                    <p class="text-muted">No offers available today.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    
    <section class="mb-5">
        <div class="row g-4 text-center">
            <div class="col-md-6">
                <div class="p-5 rounded-xl shadow-sm d-flex flex-column justify-content-center align-items-start h-100" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); min-height: 200px;">
                    <h4 class="fw-bold text-dark">Headache & Migraine Solutions</h4>
                    <p class="text-muted mb-4 text-start">Quick relief for your daily activities.</p>
                    <a href="products?category=1" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">Shop Relief</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5 rounded-xl shadow-sm d-flex flex-column justify-content-center align-items-start h-100" style="background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%); min-height: 200px;">
                    <h4 class="fw-bold text-dark">Skin Health & Glow Essentials</h4>
                    <p class="text-muted mb-4 text-start">Vitamins for a healthier, glowing skin.</p>
                    <a href="products?category=3" class="btn btn-light text-danger fw-bold rounded-pill px-4 shadow-sm">Shop Vitamins</a>
                </div>
            </div>
        </div>
    </section>

</div>
<?= $this->endSection(); ?>