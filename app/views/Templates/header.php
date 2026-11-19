<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= DESKRIPSI; ?>">
    <meta name="keywords" content="<?= KEYWORD; ?>">
    <meta name="author" content="hdev.web.id">
    <link rel="icon" href="<?= BASEURL; ?>assets/img/icon/icon32x32.png" type="image/png" />
    <link rel="shortcut icon" href="<?= BASEURL; ?>assets/img/icon/icon32x32.png" type="image/png"/>
    <link rel="manifest" href="<?= BASEURL."web.manifest"; ?>">
    <title><?= TITLE; ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <!-- Bootstrap ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <!-- Sweet Alert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- datatables CSS -->
    <link href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap5.css" rel="stylesheet">
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
    <!-- JQuery JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
      /* ===== DESIGN SYSTEM ===== */
      :root {
        --primary: #2d6a4f;
        --primary-light: #40916c;
        --primary-lighter: #52b788;
        --primary-pale: #d8f3dc;
        --primary-bg: #f0faf4;
        --dark: #2d3748;
        --dark-light: #4a5568;
        --dark-lighter: #718096;
        --gray-50: #f7fafc;
        --gray-100: #edf2f7;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e0;
        --gray-500: #a0aec0;
        --white: #ffffff;
        --danger: #e53e3e;
        --warning: #dd6b20;
        --warning-bg: #fffaf0;
        --info: #3182ce;
        --info-bg: #ebf8ff;
        --success: #38a169;
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.07);
        --shadow-lg: 0 10px 25px rgba(0,0,0,0.08);
        --transition: all 0.2s ease;
      }

      * {
        font-family: "Inter", sans-serif;
        -webkit-font-smoothing: antialiased;
      }

      body {
        background-color: var(--gray-50);
        color: var(--dark);
        padding-bottom: 90px;
        min-height: 100vh;
      }

      /* ===== HEADER ===== */
      .app-header {
        background: var(--dark);
        padding: 14px 0;
        position: sticky;
        top: 0;
        z-index: 1030;
        box-shadow: var(--shadow-sm);
      }
      .app-header .container-fluid {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .app-header img {
        height: 36px;
        width: auto;
      }
      .app-header .brand-name {
        color: var(--white);
        font-weight: 600;
        font-size: 1.1rem;
        letter-spacing: -0.01em;
      }

      /* ===== CARDS ===== */
      .card {
        border: none;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        overflow: hidden;
      }
      .card:hover {
        box-shadow: var(--shadow-md);
      }
      .card-header {
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        font-weight: 600;
        font-size: 0.95rem;
        padding: 14px 18px;
      }
      .card-body {
        padding: 18px;
      }

      /* ===== STAT BOX (replaces info-box) ===== */
      .stat-box {
        display: flex;
        align-items: center;
        background: var(--white);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        padding: 16px;
        margin-bottom: 12px;
        gap: 14px;
      }
      .stat-box .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
        background: var(--primary-pale);
        color: var(--primary);
        font-size: 1.3rem;
        flex-shrink: 0;
      }
      .stat-box .stat-icon img {
        width: 28px;
        height: 28px;
        object-fit: contain;
      }
      .stat-box .stat-content {
        flex: 1;
        min-width: 0;
      }
      .stat-box .stat-label {
        font-size: 0.75rem;
        color: var(--dark-lighter);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 500;
        margin-bottom: 2px;
      }
      .stat-box .stat-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1.2;
      }
      .stat-box .stat-divider {
        width: 1px;
        height: 36px;
        background: var(--gray-200);
        flex-shrink: 0;
      }
      .stat-box .stat-badge {
        background: var(--dark);
        color: var(--white);
        border-radius: var(--radius-sm);
        padding: 8px 14px;
        text-align: center;
        flex-shrink: 0;
      }
      .stat-box .stat-badge small {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        opacity: 0.8;
      }
      .stat-box .stat-badge .stat-badge-value {
        font-size: 1rem;
        font-weight: 700;
      }

      /* Legacy info-box support */
      .info-box {
        display: flex;
        align-items: center;
        background: var(--white);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        padding: 14px;
        margin-bottom: 12px;
        gap: 12px;
        min-height: auto;
        width: 100%;
        position: relative;
      }
      .info-box .info-box-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
        background: var(--primary-pale);
        font-size: 1.2rem;
        flex-shrink: 0;
      }
      .info-box .info-box-icon img {
        width: 26px;
        height: 26px;
        object-fit: contain;
      }
      .info-box .info-box-content {
        flex: 1;
        min-width: 0;
      }
      .info-box .info-box-text {
        font-size: 0.72rem;
        color: var(--dark-lighter);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 500;
      }
      .info-box .info-box-number {
        font-weight: 700;
        color: var(--dark);
        line-height: 1.2;
      }
      .info-box h3.info-box-number {
        font-size: 1.2rem;
        margin: 0;
      }
      .info-box h5 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
      }

      /* ===== SECTION TITLE ===== */
      .section-title {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: var(--white);
        border-radius: var(--radius-md);
        padding: 14px 18px;
        font-weight: 600;
        font-size: 0.95rem;
        text-align: center;
        margin-bottom: 16px;
      }

      /* ===== BUTTONS ===== */
      .btn-primary {
        background: var(--primary);
        border-color: var(--primary);
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 0.875rem;
        padding: 8px 16px;
        transition: var(--transition);
      }
      .btn-primary:hover, .btn-primary:focus {
        background: var(--primary-light);
        border-color: var(--primary-light);
        box-shadow: 0 2px 8px rgba(45,106,79,0.25);
      }
      .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 0.875rem;
      }
      .btn-outline-primary:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
      }
      .btn-danger {
        border-radius: var(--radius-sm);
        font-weight: 500;
      }
      .btn-warning {
        border-radius: var(--radius-sm);
        font-weight: 500;
      }
      .btn-sm {
        padding: 6px 12px;
        font-size: 0.8rem;
      }

      /* ===== TABLES ===== */
      .table {
        font-size: 0.875rem;
      }
      .table th {
        font-weight: 600;
        color: var(--dark);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        border-bottom: 2px solid var(--gray-200);
      }
      .table td {
        vertical-align: middle;
        color: var(--dark-light);
      }

      /* ===== FORMS ===== */
      .form-control, .form-select {
        border: 1.5px solid var(--gray-300);
        border-radius: var(--radius-sm);
        font-size: 0.875rem;
        padding: 10px 14px;
        transition: var(--transition);
      }
      .form-control:focus, .form-select:focus {
        border-color: var(--primary-lighter);
        box-shadow: 0 0 0 3px rgba(82,183,136,0.15);
      }
      .form-label {
        font-weight: 500;
        font-size: 0.85rem;
        color: var(--dark);
        margin-bottom: 4px;
      }

      /* ===== MODALS ===== */
      .modal-content {
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
      }
      .modal-header {
        border-bottom: 1px solid var(--gray-200);
        padding: 18px 20px;
      }
      .modal-title {
        font-weight: 600;
        font-size: 1.05rem;
        color: var(--dark);
      }
      .modal-body {
        padding: 20px;
      }
      .modal-footer {
        border-top: 1px solid var(--gray-200);
        padding: 14px 20px;
      }

      /* ===== ACCORDION ===== */
      .accordion-item {
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm) !important;
        margin-bottom: 8px;
        overflow: hidden;
      }
      .accordion-button {
        font-weight: 500;
        font-size: 0.9rem;
        color: var(--dark);
        padding: 14px 16px;
      }
      .accordion-button:not(.collapsed) {
        background: var(--primary-bg);
        color: var(--primary);
        box-shadow: none;
      }
      .accordion-button:focus {
        box-shadow: none;
        border-color: var(--primary-lighter);
      }
      .accordion-body {
        padding: 14px 16px;
        font-size: 0.875rem;
      }

      /* ===== ALERTS ===== */
      .alert {
        border-radius: var(--radius-sm);
        font-size: 0.875rem;
        border: none;
        padding: 14px 16px;
      }
      .alert-info {
        background: var(--info-bg);
        color: var(--info);
      }
      .alert-warning {
        background: var(--warning-bg);
        color: var(--warning);
      }

      /* ===== BADGES ===== */
      .badge {
        font-weight: 500;
        font-size: 0.72rem;
        padding: 5px 10px;
        border-radius: 20px;
      }

      /* ===== NAV TABS ===== */
      .nav-tabs {
        border-bottom: 2px solid var(--gray-200);
      }
      .nav-tabs .nav-link {
        color: var(--dark-lighter);
        font-weight: 500;
        font-size: 0.875rem;
        border: none;
        padding: 10px 16px;
        border-radius: 0;
        transition: var(--transition);
      }
      .nav-tabs .nav-link.active {
        color: var(--primary);
        border-bottom: 2px solid var(--primary);
        background: transparent;
      }
      .nav-tabs .nav-link:hover {
        color: var(--primary);
      }

      /* ===== DATATABLE OVERRIDES ===== */
      .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid var(--gray-300);
        border-radius: var(--radius-sm);
        padding: 6px 12px;
        font-size: 0.85rem;
      }
      .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: var(--white) !important;
        border-radius: var(--radius-sm);
      }

      /* ===== SCROLLBAR ===== */
      ::-webkit-scrollbar { width: 6px; height: 6px; }
      ::-webkit-scrollbar-track { background: transparent; }
      ::-webkit-scrollbar-thumb { background: var(--gray-300); border-radius: 3px; }

      /* ===== UTILITY ===== */
      .text-primary { color: var(--primary) !important; }
      .bg-primary-pale { background-color: var(--primary-pale) !important; }
      .bg-primary-gradient {
        background: linear-gradient(135deg, var(--primary), var(--primary-light)) !important;
      }
      .rounded-app { border-radius: var(--radius-md); }
      .gap-3 { gap: 1rem; }

      /* ===== RESPONSIVE ===== */
      @media (max-width: 576px) {
        .container, .container-fluid { padding-left: 16px; padding-right: 16px; }
        .stat-box { padding: 12px; gap: 10px; }
        .stat-box .stat-value { font-size: 1.1rem; }
        .card-body { padding: 14px; }
      }
    </style>
  </head>
  <body>
    <?php
      $geturl = explode("=",$_SERVER['QUERY_STRING']);
      $lastvalue = array_pop($geturl);
    ?>
    <div class="app-header">
      <div class="container-fluid">
        <img src="<?=BASEURL;?>assets/img/logo.png" alt="Logo"/>
        <span class="brand-name">Disapu</span>
      </div>
    </div>
