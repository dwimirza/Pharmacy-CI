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
            <h2 class="fw-bold" style="color: var(--primary-color);">Pharmacy Inventory</h2>
            <ul class="nav nav-pills mt-2">
                <li class="nav-item">
                    <a class="nav-link text-dark bg-white border rounded-pill px-4 hover-primary" href="/admin/medicines">Medicines</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active rounded-pill px-4 ms-2 shadow-sm" href="/admin/categories" style="background-color: var(--primary-color);">Categories</a>
                </li>
            </ul>
        </div>
        
        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-2"></i> Add Category
        </button>
    </div>

    <div class="card card-shadow border-0 rounded-xl">
        <div class="card-body p-0"> 
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f3f0ff;">
                        <tr>
                            <th scope="col" class="py-3 px-4 rounded-top-start" style="width: 10%; color: var(--primary-color);">ID</th>
                            <th scope="col" class="py-3" style="width: 40%; color: var(--primary-color);">Category Name</th>
                            <th scope="col" class="py-3" style="width: 35%; color: var(--primary-color);">Slug</th>
                            <th scope="col" class="py-3 px-4 text-center rounded-top-end" style="width: 15%; color: var(--primary-color);">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($categories as $cat) : ?>
                        <tr>
                            <td class="px-4 fw-bold text-muted">#<?= $no++; ?></td>
                            <td>
                                <span class="fw-bold d-block text-dark"><?= esc($cat['name']); ?></span>
                            </td>
                            <td>
                                <span class="text-muted bg-light px-2 py-1 rounded small border">
                                    /<?= esc($cat['slug']); ?>
                                </span>
                            </td>
                            <td class="px-4 text-center">
                                <form action="/admin/categories/delete/<?= $cat['id']; ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete" onclick="return confirm('Are you sure you want to delete this category?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($categories)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">No categories found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-xl border-0 shadow">
            <div class="modal-header border-bottom-0 bg-light rounded-top-xl">
                <h5 class="modal-title fw-bold" style="color: var(--primary-color);"><i class="fas fa-tags me-2"></i> Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/admin/categories/store" method="post">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Category Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="e.g. Skin Care">
                        <div class="form-text mt-2"><i class="fas fa-info-circle"></i> Slug will be generated automatically.</div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light rounded-bottom-xl">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->section('extra-css'); ?>
<style>
    .table > :not(caption) > * > * { border-bottom-color: #f1f1f1; }
    .modal-content { overflow: hidden; }
    .hover-primary:hover { color: var(--primary-color) !important; background-color: #f3f0ff !important; border-color: transparent !important; }
</style>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>