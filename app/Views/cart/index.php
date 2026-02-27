<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container my-5">

    <h2 class="fw-bold mb-4" style="color: var(--primary-color);">
        <i class="fas fa-shopping-cart me-2"></i> Your Cart
    </h2>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert">
        <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card card-shadow border-0 rounded-xl">
                <div class="card-body p-4">

                    <?php if(empty($cart)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-cart-arrow-down fa-4x text-light mb-3"></i>
                        <h5 class="fw-bold text-muted">Your cart is empty!</h5>
                        <p class="text-muted mb-4">Looks like you haven't added any medicines yet.</p>
                        <a href="/products" class="btn btn-primary rounded-pill px-4">Browse Products</a>
                    </div>
                    <?php else: ?>

                    <?php foreach($cart as $item): ?>
                    <div class="row align-items-center mb-4 pb-4 border-bottom">
                        <div class="col-3 col-md-2">
                            <?php if(!empty($item['image_url'])): ?>
                            <img src="/uploads/medicines/<?= esc($item['image_url']); ?>"
                                class="img-fluid rounded border" alt="<?= esc($item['name']); ?>">
                            <?php else: ?>
                            <img src="https://placehold.co/100x100?text=No+Img" class="img-fluid rounded border">
                            <?php endif; ?>
                        </div>

                        <div class="col-9 col-md-4">
                            <h6 class="fw-bold mb-1"><a href="/product/<?= $item['medicine_id']; ?>"
                                    class="text-decoration-none text-dark hover-primary"><?= esc($item['name']); ?></a>
                            </h6>
                            <p class="text-muted small mb-0">Rp <?= number_format($item['price'], 0, ',', '.'); ?> /
                                item</p>
                        </div>

                        <div class="col-6 col-md-3 mt-3 mt-md-0">
                            <div class="d-flex align-items-center bg-light rounded-pill p-1"
                                style="width: fit-content;">
                                <form action="/cart/update" method="post">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id']; ?>">
                                    <input type="hidden" name="action" value="minus">
                                    <button type="submit" class="btn btn-sm btn-light rounded-circle fw-bold"
                                        <?= $item['quantity'] <= 1 ? 'disabled' : ''; ?>>-</button>
                                </form>

                                <span class="mx-3 fw-bold"><?= $item['quantity']; ?></span>

                                <form action="/cart/update" method="post">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id']; ?>">
                                    <input type="hidden" name="action" value="plus">
                                    <button type="submit" class="btn btn-sm btn-light rounded-circle fw-bold"
                                        <?= $item['quantity'] >= $item['stock'] ? 'disabled' : ''; ?>>+</button>
                                </form>
                            </div>
                            <?php if($item['quantity'] >= $item['stock']): ?>
                            <small class="text-danger" style="font-size: 0.7rem;">Max stock reached</small>
                            <?php endif; ?>
                        </div>

                        <div class="col-6 col-md-3 mt-3 mt-md-0 text-end">
                            <h6 class="fw-bold" style="color: var(--primary-color);">Rp
                                <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></h6>
                            <a href="/cart/remove/<?= $item['cart_id']; ?>"
                                class="text-danger small text-decoration-none"
                                onclick="return confirm('Remove this item?');">
                                <i class="fas fa-trash-alt me-1"></i> Remove
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if(!empty($cart)): ?>
        <div class="col-lg-4">
            <div class="card card-shadow border-0 rounded-xl">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Subtotal</span>
                        <span>Rp <?= number_format($total, 0, ',', '.'); ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5" style="color: var(--primary-color);">Rp
                            <?= number_format($total, 0, ',', '.'); ?></span>
                    </div>
                    <form action="/checkout" method="post" id="checkout-form">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="payment_method" id="payment_method" value="">
                        <button type="button" class="btn btn-primary rounded-pill w-100 py-2 fw-bold shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#paymentModal">
                            Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<!-- Payment Method Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-xl">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="paymentModalLabel">
            Choose Payment Method
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="payment_method_option"
                 id="pay_cash" value="cash" checked>
          <label class="form-check-label" for="pay_cash">
            Cash
          </label>
        </div>

        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="payment_method_option"
                 id="pay_credit" value="credit">
          <label class="form-check-label" for="pay_credit">
            Credit Card
          </label>
        </div>

      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary rounded-pill px-4" id="confirm-payment">
          Confirm & Checkout
        </button>
      </div>
    </div>
  </div>
</div>


<?= $this->section('extra-js'); ?>
<script>
document.getElementById('confirm-payment').addEventListener('click', function () {
    const selected = document.querySelector('input[name="payment_method_option"]:checked');
    if (!selected) return;

    // isi hidden input di form utama
    document.getElementById('payment_method').value = selected.value;

    // submit form checkout
    document.getElementById('checkout-form').submit();
});
</script>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>