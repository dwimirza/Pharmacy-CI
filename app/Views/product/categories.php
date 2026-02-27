<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('extra-css'); ?>
<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    .category-icon {
        width: 80px;
        height: 80px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #f3f0ff;
        border-radius: 50%;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container my-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: var(--primary-color);">Browse by Category</h2>
        <p class="text-muted">Explore our wide range of pharmacy products tailored for your health needs.</p>
    </div>

    <div class="row g-4">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="/products?category=<?= $cat['id']; ?>" class="text-decoration-none text-dark">
                        <div class="card card-shadow border-0 rounded-xl h-100 transition-hover text-center p-4">
                            <div class="card-body p-0">
                                
                                <div class="category-icon">
                                    <i class="fas fa-pills fa-2x"></i>
                                </div>
                                
                                <h5 class="fw-bold mb-0"><?= esc($cat['name']); ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">No categories available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>

</div>
<?= $this->endSection(); ?>