<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container my-5">

    <h2 class="fw-bold mb-4" style="color: var(--primary-color);">
        <i class="fas fa-history me-2"></i> My Orders
    </h2>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            
            <?php if (empty($orders)): ?>
                <div class="card card-shadow border-0 rounded-xl text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-box-open fa-4x text-light mb-3"></i>
                        <h5 class="fw-bold text-muted">No Orders Yet</h5>
                        <p class="text-muted mb-4">You haven't made any purchases. Start exploring our medicines!</p>
                        <a href="/products" class="btn btn-primary rounded-pill px-4">Browse Products</a>
                    </div>
                </div>
            <?php else: ?>

                <?php foreach ($orders as $order): ?>
                    <div class="card card-shadow border-0 rounded-xl mb-4 overflow-hidden">
                        
                        <div class="card-header bg-light border-bottom-0 py-3 px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small d-block mb-1">
                                    <i class="far fa-calendar-alt me-1"></i> <?= date('d M Y, H:i', strtotime($order['created_at'])); ?>
                                </span>
                                <span class="fw-bold" style="color: var(--primary-color);">
                                    Order ID: #MCR-<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?>
                                </span>
                            </div>
                            <div>
                                <?php if ($order['status'] == 'pending'): ?>
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 border"><i class="fas fa-clock me-1"></i> Pending</span>
                                <?php elseif ($order['status'] == 'completed'): ?>
                                    <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check-circle me-1"></i> Completed</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary rounded-pill px-3 py-2"><?= ucfirst($order['status']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                
                                <div class="col-md-8 border-end-md pe-md-4">
                                    <h6 class="fw-bold mb-3 text-muted small text-uppercase">Items Purchased</h6>
                                    
                                    <?php foreach ($order['details'] as $detail): ?>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="me-3" style="width: 60px; height: 60px; flex-shrink: 0;">
                                                <?php if (!empty($detail['image_url'])): ?>
                                                    <img src="/uploads/medicines/<?= esc($detail['image_url']); ?>" class="img-fluid rounded border w-100 h-100" style="object-fit: cover;">
                                                <?php else: ?>
                                                    <img src="https://placehold.co/100x100?text=Img" class="img-fluid rounded border w-100 h-100" style="object-fit: cover;">
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-0 text-dark"><?= esc($detail['name'] ?? 'Unknown Medicine'); ?></h6>
                                                <small class="text-muted"><?= $detail['quantity']; ?> x Rp <?= number_format($detail['price'], 0, ',', '.'); ?></small>
                                            </div>
                                            <div class="text-end fw-bold text-dark">
                                                Rp <?= number_format($detail['quantity'] * $detail['price'], 0, ',', '.'); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="col-md-4 ps-md-4 mt-4 mt-md-0">
                                    <h6 class="fw-bold mb-3 text-muted small text-uppercase">Order Summary</h6>
                                    
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Payment:</span>
                                        <span class="fw-medium"><?= esc($order['payment_method'] ?? 'N/A'); ?></span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <span class="text-muted d-block mb-1">Shipping Address:</span>
                                        <small class="fw-medium text-dark d-block bg-light p-2 rounded"><?= esc($order['shipping_address'] ?? 'No address provided'); ?></small>
                                    </div>

                                    <hr>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Total</span>
                                        <h5 class="fw-bold mb-0" style="color: var(--primary-color);">Rp <?= number_format($order['total_amount'], 0, ',', '.'); ?></h5>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->section('extra-css'); ?>
<style>
    @media (min-width: 768px) {
        .border-end-md {
            border-right: 1px solid #dee2e6 !important;
        }
    }
</style>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>