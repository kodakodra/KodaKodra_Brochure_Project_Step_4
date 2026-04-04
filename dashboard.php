<?php
/* ============================================================
   dashboard.php — Logged-in user's personal page
   ============================================================
   Only accessible to logged-in users via auth.php.
   Shows a welcome message and basic account info.
   Will be expanded in Step 5 to show submissions and tickets.
   ============================================================ */

require_once 'includes/config.php';
require_once 'includes/auth.php';

$pageTitle = 'Dashboard';
require_once 'includes/header.php';
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <p class="page-label">Dashboard</p>
            <h1 class="page-title">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
            <p class="page-sub">You are logged in as <?= htmlspecialchars($_SESSION['user_role']) ?>.</p>
        </div>
    </div>

    <!-- Dashboard Content -->
    <section id="dashboard">
        <div class="container">
            <div class="row g-4">

                <!-- Account Info -->
                <div class="col-md-6 col-lg-4">
                    <div class="dashboard-card">
                        <div class="dashboard-card__icon"><i class="fas fa-user"></i></div>
                        <h5>Account</h5>
                        <p>Logged in as <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>.</p>
                        <p>Role: <strong><?= htmlspecialchars($_SESSION['user_role']) ?></strong></p>
                    </div>
                </div>

                <!-- Placeholder — submissions in Step 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="dashboard-card">
                        <div class="dashboard-card__icon"><i class="fas fa-envelope"></i></div>
                        <h5>Contact Submissions</h5>
                        <p>Your contact form submissions will appear here in the next update.</p>
                    </div>
                </div>

                <!-- Placeholder — tickets in Step 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="dashboard-card">
                        <div class="dashboard-card__icon"><i class="fas fa-ticket"></i></div>
                        <h5>Support Tickets</h5>
                        <p>Your support tickets will appear here in the next update.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
