<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
All Products
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container my-5">
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none" style="color: var(--primary-color);">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card card-shadow rounded-xl p-4 border-0">
                <h5 class="fw-bold mb-3">Categories</h5>
                <ul class="list-unstyled mb-4">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-primary">Vitamins & Supplements</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-primary">Personal Care</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-primary">First Aid</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-primary">Mother & Baby</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-primary">Skin Care</a></li>
                </ul>

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
                <?php for($i=1; $i<=9; $i++): ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-shadow rounded-xl h-100 border-0 transition-hover">
                        <div class="card-body p-4 text-center position-relative">
                            <button class="btn btn-sm position-absolute top-0 end-0 mt-2 me-2 text-danger border-0 bg-transparent">
                                <i class="far fa-heart fs-5"></i>
                            </button>
                            
                            <img src="https://placehold.co/150x150/png?text=Medicine+<?= $i ?>" class="img-fluid mb-3 rounded" alt="Product">
                            
                            <p class="text-muted small mb-1 text-start">Mecura Pharma</p>
                            <h6 class="fw-bold text-start text-truncate">Essential Health Medicine <?= $i ?></h6>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="fw-bold mb-0" style="color: var(--primary-color);">Rp <?= number_format(rand(15, 150) * 1000, 0, ',', '.') ?></h5>
                                <button class="btn btn-primary-soft rounded-pill px-3 btn-sm"><i class="fas fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link border-0 bg-transparent" href="#">Prev</a></li>
                    <li class="page-item active"><a class="page-link rounded-circle mx-1" style="background-color: var(--primary-color); border-color: var(--primary-color);" href="#">1</a></li>
                    <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 text-dark" href="#">2</a></li>
                    <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 text-dark" href="#">3</a></li>
                    <li class="page-item"><a class="page-link border-0 text-dark bg-transparent" href="#">Next</a></li>
                </ul>
            </nav>

        </div>
    </div>
</div>

<?= $this->section('extra-css'); ?>
<style>
    .transition-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
    .hover-primary:hover { color: var(--primary-color) !important; }
</style>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>