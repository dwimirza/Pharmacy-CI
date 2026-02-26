<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
<?= esc($product['name']); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container my-5">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none" style="color: var(--primary-color);">Home</a></li>
            <li class="breadcrumb-item"><a href="/products" class="text-decoration-none" style="color: var(--primary-color);">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($product['name']); ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-md-5">
            <div class="card card-shadow border-0 rounded-xl mb-4">
                <div class="card-body p-4 text-center">
                    <?php if(!empty($product['image_url'])): ?>
                        <img src="/uploads/medicines/<?= esc($product['image_url']); ?>" class="img-fluid rounded" alt="<?= esc($product['name']); ?>" style="max-height: 350px; object-fit: contain;">
                    <?php else: ?>
                        <img src="https://placehold.co/400x400/e9ecef/adb5bd?text=No+Image" class="img-fluid rounded" alt="No Image">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            
            <div class="mb-4">
                <span class="badge bg-light text-primary border border-primary-subtle rounded-pill px-3 py-2 mb-2">
                    <?= esc($product['category_name'] ?? 'Uncategorized'); ?>
                </span>
                <h2 class="fw-bold mb-2"><?= esc($product['name']); ?></h2>
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">Rp <?= number_format($product['price'], 0, ',', '.'); ?></h3>
                
                <div class="d-flex gap-3 align-items-center mb-4">
                    
                    <form action="/cart/add" method="post" class="w-100 m-0">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                        <input type="hidden" name="qty" value="1">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm w-100" <?= $product['stock'] < 1 ? 'disabled' : ''; ?>>
                            <i class="fas fa-cart-plus me-2"></i> <?= $product['stock'] < 1 ? 'Out of Stock' : 'Add to Cart'; ?>
                        </button>
                    </form>
                    <div class="w-100">
                        <?php if($product['stock'] > 10): ?>
                            <span class="text-success small fw-bold"><i class="fas fa-check-circle me-1"></i> In Stock (<?= $product['stock']; ?>)</span>
                        <?php elseif($product['stock'] > 0): ?>
                            <span class="text-warning small fw-bold"><i class="fas fa-exclamation-circle me-1"></i> Low Stock (<?= $product['stock']; ?>)</span>
                        <?php else: ?>
                            <span class="text-danger small fw-bold"><i class="fas fa-times-circle me-1"></i> Out of Stock</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card card-shadow border-0 rounded-xl mb-4" style="background-color: #f8fcf8; border-left: 4px solid #198754 !important;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-success"><i class="fas fa-file-medical-alt me-2"></i> Description & Benefits</h5>
                    <p class="text-muted mb-0" style="line-height: 1.7;">
                        <?= nl2br(esc($product['description'] ?? 'No description available for this product.')); ?>
                    </p>
                </div>
            </div>

            <div class="card card-shadow border-0 rounded-xl mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i> Product Details</h5>
                    
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width: 40%;">Generic Name</td>
                                <td class="fw-medium"><?= esc($product['generic_name'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Brand Name</td>
                                <td class="fw-medium"><?= esc($product['brand_name'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Manufacturer</td>
                                <td class="fw-medium"><?= esc($product['manufacturer'] ?? '-'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if($product['requires_prescription'] == 1): ?>
            <div class="card border-0 rounded-xl" style="background-color: #fff3cd; border-left: 4px solid #ffc107 !important;">
                <div class="card-body p-4 d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x me-3"></i>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Prescription Required</h6>
                        <p class="text-muted small mb-0">You need a valid doctor's prescription to purchase this medicine.</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>