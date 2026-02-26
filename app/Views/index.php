<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
Home
<?= $this->endSection(); ?>

<?= $this->section('extra-css'); ?>
<style>
    .hero-section {
        /* Gradient purple background matching moodboard */
        background: linear-gradient(135deg, #eadaff 0%, #f3f0ff 100%);
        border-radius: 30px;
        overflow: hidden;
        margin-top: 20px;
    }
    .category-circle {
        width: 80px; height: 80px; background: #fff; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
</style>
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<div class="container">
    <section class="hero-section p-5 mb-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="badge bg-white text-primary mb-3 rounded-pill px-3 py-2">Introducing Mecura</span>
                <h1 class="display-4 fw-bold mb-4" style="color: var(--primary-color);">Your Online <br> Pharmacy Marketplace</h1>
                <p class="lead text-muted mb-4">Find medicines, vitamins, and health products from trusted sellers delivered to you safely.</p>
                <a href="#todays-offer" class="btn btn-primary rounded-pill px-4 py-2 me-2">Shop Now <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
            <div class="col-md-6 text-end d-none d-md-block">
                 <img src="https://placehold.co/500x400/6f42c1/ffffff?text=Doctor+Image+Here" alt="Pharmacy" class="img-fluid rounded-xl">
            </div>
        </div>
    </section>

    <section class="mb-5 text-center">
        <h3 class="section-title">Our Popular Categories</h3>
        <div class="row justify-content-center g-4">
             <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
                <div class="col-6 col-md-2">
                    <a href="#" class="text-decoration-none text-dark">
                        <div class="category-circle">
                            <i class="fas fa-pills fa-2x text-primary"></i>
                        </div>
                        <h6 class="fw-bold mt-3">
                            <?= esc($cat['name']) ?>
                        </h6>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">No categories available.</p>
        <?php endif; ?>
        </div>
    </section>

    <section class="mb-5" id="todays-offer">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="section-title mb-0">Today's Best Offer<br><small class="text-muted fw-normal fs-5">Just For You</small></h3>
            <a href="#" class="btn btn-outline-primary rounded-pill px-4">See all <i class="fas fa-arrow-right ms-1"></i></a>
        </div>

        <div class="row g-4">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
            <div class="col-md-3 col-6">
                <div class="card card-shadow rounded-xl h-100">
                    <div class="card-body p-4 text-center position-relative">
                        <button class="btn btn-sm position-absolute top-0 end-0 mt-2 me-2 text-danger"><i class="far fa-heart"></i></button>
                        <img src="https://placehold.co/150x150/png?text=Product-" class="img-fluid mb-3 rounded" alt="Product">
                        <p class="text-muted small mb-1 text-start"><?= esc($product['category_name']) ?></p>
                        <h6 class="fw-bold text-start"><?= esc($product['name']) ?></h6>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h5 class="fw-bold mb-0">$12.50</h5>
                            <button class="btn btn-primary-soft rounded-pill px-3 btn-sm"><i class="fas fa-cart-plus me-1"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">No products available.</p>
            <?php endif; ?>
        </div>
    </section>
    
    <section class="mb-5 text-center">
          <h3 class="section-title mb-4">Our Seasonal Exclusive Solutions</h3>
          <div class="row g-3">
              <div class="col-md-6">
                  <div class="p-5 rounded-xl text-start" style="background: #e3f2fd;">
                      <h4>Headache & Migraine Solutions</h4>
                       <button class="btn btn-sm btn-light rounded-pill mt-3 px-3">See more</button>
                  </div>
              </div>
               <div class="col-md-6">
                  <div class="p-5 rounded-xl text-start" style="background: #ffebee;">
                      <h4>Skin Health & Glow Essentials</h4>
                      <button class="btn btn-sm btn-light rounded-pill mt-3 px-3">See more</button>
                  </div>
              </div>
          </div>
     </section>
</div>

<?= $this->endSection(); ?>