<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container my-5">
    
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-pill" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold" style="color: var(--primary-color);">Manage Medicines</h2>
            <p class="text-muted">Manage inventory, pricing, and pharmacy product information.</p>
        </div>
        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
            <i class="fas fa-plus me-2"></i> Add Medicine
        </button>
    </div>

    <div class="card card-shadow border-0 rounded-xl">
        <div class="card-body p-0"> 
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f3f0ff;">
                        <tr>
                            <th scope="col" class="py-3 px-4 rounded-top-start" style="color: var(--primary-color);">ID</th>
                            <th scope="col" class="py-3" style="color: var(--primary-color);">Image</th>
                            <th scope="col" class="py-3" style="color: var(--primary-color);">Medicine Name</th>
                            <th scope="col" class="py-3" style="color: var(--primary-color);">Price</th>
                            <th scope="col" class="py-3" style="color: var(--primary-color);">Stock</th>
                            <th scope="col" class="py-3 px-4 text-center rounded-top-end" style="color: var(--primary-color);">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($medicines as $med) : ?>
                        <tr>
                            <td class="px-4 fw-bold text-muted">#<?= $no++; ?></td>
                            <td>
                                <?php if($med['image_url']): ?>
                                    <img src="/uploads/medicines/<?= $med['image_url']; ?>" class="rounded" alt="<?= $med['name']; ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    <img src="https://placehold.co/50x50/png?text=No+Img" class="rounded" alt="<?= $med['name']; ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="fw-bold d-block text-dark"><?= $med['name']; ?></span>
                                <small class="text-muted">Category: <?= $med['category_name'] ?? 'Uncategorized'; ?></small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill border">
                                    Rp <?= number_format($med['price'], 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td>
                                <?php if($med['stock'] > 10): ?>
                                    <span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> <?= $med['stock']; ?></span>
                                <?php elseif($med['stock'] > 0): ?>
                                    <span class="text-warning fw-bold"><i class="fas fa-exclamation-circle me-1"></i> <?= $med['stock']; ?></span>
                                <?php else: ?>
                                    <span class="text-danger fw-bold"><i class="fas fa-times-circle me-1"></i> Out of Stock</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-circle me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editMedicineModal<?= $med['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form action="/admin/medicines/<?= $med['id']; ?>" method="post" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-xl border-0 shadow">
            <div class="modal-header border-bottom-0 bg-light rounded-top-xl">
                <h5 class="modal-title fw-bold" style="color: var(--primary-color);"><i class="fas fa-plus-circle me-2"></i> Add New Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/medicines/store" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Medicine Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="e.g. Paracetamol 500mg">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Generic Name</label>
                            <input type="text" class="form-control" name="generic_name" placeholder="e.g. Acetaminophen">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Brand Name</label>
                            <input type="text" class="form-control" name="brand_name" placeholder="e.g. Panadol">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Manufacturer</label>
                            <input type="text" class="form-control" name="manufacturer" placeholder="e.g. Mecura Pharma">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Category</label>
                            <select class="form-select" name="category_id" required>
                                <option value="" selected disabled>-- Select Category --</option>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small">Prescription?</label>
                            <select class="form-select" name="requires_prescription" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Price (Rp)</label>
                            <input type="number" class="form-control" name="price" required placeholder="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Stock Quantity</label>
                            <input type="number" class="form-control" name="stock" required placeholder="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter description..."></textarea>
                        </div>
                        <div class="col-12 mt-2 pt-3 border-top">
                            <label class="form-label fw-bold small">Product Image</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center">
                                    <p class="mb-2 small text-muted" style="font-size: 0.75rem;">Current Image</p>
                                    <?php if($med['image_url']): ?>
                                        <img src="/uploads/medicines/<?= $med['image_url']; ?>" class="rounded shadow-sm border" alt="Current Image" style="width: 70px; height: 70px; object-fit: cover;">
                                    <?php else: ?>
                                        <img src="https://placehold.co/70x70/png?text=No+Img" class="rounded shadow-sm border" alt="No Image" style="width: 70px; height: 70px; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                                
                                <div class="flex-grow-1">
                                    <p class="mb-2 small text-muted" style="font-size: 0.75rem;">Upload Image</p>
                                    <input type="file" class="form-control" name="image_url" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light rounded-bottom-xl">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Add Medicine</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($medicines as $med) : ?>
<div class="modal fade" id="editMedicineModal<?= $med['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-xl border-0 shadow">
            <div class="modal-header border-bottom-0 bg-light rounded-top-xl">
                <h5 class="modal-title fw-bold" style="color: var(--primary-color);"><i class="fas fa-edit me-2"></i> Edit Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/admin/medicines/update/<?= $med['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Medicine Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $med['name']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Generic Name</label>
                            <input type="text" class="form-control" name="generic_name" value="<?= $med['generic_name']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Brand Name</label>
                            <input type="text" class="form-control" name="brand_name" value="<?= $med['brand_name']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Manufacturer</label>
                            <input type="text" class="form-control" name="manufacturer" value="<?= $med['manufacturer']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Category</label>
                            <select class="form-select" name="category_id" required>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id']; ?>" <?= ($med['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                        <?= $cat['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small">Prescription?</label>
                            <select class="form-select" name="requires_prescription" required>
                                <option value="0" <?= ($med['requires_prescription'] == 0) ? 'selected' : ''; ?>>No</option>
                                <option value="1" <?= ($med['requires_prescription'] == 1) ? 'selected' : ''; ?>>Yes</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="active" <?= ($med['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= ($med['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Price (Rp)</label>
                            <input type="number" class="form-control" name="price" value="<?= $med['price']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Stock Quantity</label>
                            <input type="number" class="form-control" name="stock" value="<?= $med['stock']; ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Description</label>
                            <textarea class="form-control" name="description" rows="3"><?= $med['description']; ?></textarea>
                        </div>
                        <div class="col-12 mt-2 pt-3 border-top">
                            <label class="form-label fw-bold small">Product Image</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center">
                                    <p class="mb-2 small text-muted" style="font-size: 0.75rem;">Current Image</p>
                                    <?php if($med['image_url']): ?>
                                        <img src="/uploads/medicines/<?= $med['image_url']; ?>" class="rounded shadow-sm border" alt="Current Image" style="width: 70px; height: 70px; object-fit: cover;">
                                    <?php else: ?>
                                        <img src="https://placehold.co/70x70/png?text=No+Img" class="rounded shadow-sm border" alt="No Image" style="width: 70px; height: 70px; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                                
                                <div class="flex-grow-1">
                                    <p class="mb-2 small text-muted" style="font-size: 0.75rem;">Upload New Image <span class="text-danger">*</span><br><em class="text-secondary">(Leave blank if you don't want to change the image)</em></p>
                                    <input type="file" class="form-control" name="image_url" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light rounded-bottom-xl">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Update Medicine</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?= $this->section('extra-css'); ?>
<style>
    .table > :not(caption) > * > * { border-bottom-color: #f1f1f1; }
    .modal-content { overflow: hidden; }
</style>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>