<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - Mecura Pharmacy</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #6f42c1; /* Purple from moodboard */
            --secondary-color: #f8f9fa;
            --text-dark: #333;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
        }
        /* Navbar styling */
        .navbar-brand { font-weight: bold; color: var(--text-dark); }
        .nav-link { color: #555; font-weight: 500; }
        
        /* Common utilities based on moodboard */
        .rounded-xl { border-radius: 20px !important; }
        .card-shadow { box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: none; }
        .btn-primary-soft {
            background-color: #eaddff; color: var(--primary-color); border: none; font-weight: 600;
        }
        .section-title { font-weight: 700; color: var(--text-dark); margin-bottom: 30px; }

        /* Footer */
        footer { background: #f8f9fa; padding: 50px 0; margin-top: 50px;}
    </style>

    <?= $this->renderSection('extra-css') ?>
</head>
<body>

    <?= $this->include('layout/navbar'); ?>

    <main>
        <?= $this->renderSection('content'); ?>
    </main>

    <?= $this->include('layout/footer'); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <?= $this->renderSection('extra-js') ?>
</body>
</html>