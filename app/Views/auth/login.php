<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
Create Account - Mecura
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container my-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-12 col-md-8 col-lg-5">
        <div class="card card-shadow rounded-xl border-0 p-4 p-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">Login</h2>
                <p class="text-muted">Join Mecura for a healthier tomorrow.</p>
            </div>

            <form action="/auth/login" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0 text-muted px-3"><i class="far fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control bg-light border-0 py-2" placeholder="john@example.com" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0 text-muted px-3"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control bg-light border-0 py-2" placeholder="••••••••" required>
                        <span class="input-group-text bg-light border-0 text-muted px-3" style="cursor: pointer;" onclick="togglePassword()">
                            <i class="far fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                    <small class="text-muted mt-1 mb-3  d-block">Must be at least 8 characters long.</small>
                </div>

                
                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm mb-4">
                    Create Account
                </button>

                <div class="text-center">
                    <p class="text-muted mb-0">Dont have an account? <a href="auth/register" class="text-decoration-none fw-bold" style="color: var(--primary-color);">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->section('extra-css'); ?>
<style>
    /* Styling to match the specific card look from your image */
    .card-shadow {
        box-shadow: 0 10px 40px rgba(0,0,0,0.05) !important;
    }
    
    .rounded-xl {
        border-radius: 20px !important;
    }

    .form-control:focus {
        background-color: #f8f9fa !important;
        box-shadow: none;
        border: 1px solid var(--primary-color) !important;
    }

    .input-group-text {
        border-top-left-radius: 12px !important;
        border-bottom-left-radius: 12px !important;
    }

    .form-control {
        border-top-right-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }

    /* .btn-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        transition: opacity 0.3s ease;
    } */

    .btn-primary:hover {
        opacity: 0.9;
    }
</style>
<?= $this->endSection(); ?>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
<?= $this->endSection(); ?>