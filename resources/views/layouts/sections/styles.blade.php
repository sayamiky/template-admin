<!-- ===============================
     Fonts & DataTables CSS
================================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<!-- ===============================
     Core & Theme CSS
================================ -->
@vite([
'resources/assets/vendor/fonts/remixicon/remixicon.scss',
'resources/assets/vendor/scss/core.scss',
'resources/assets/vendor/scss/theme-default.scss',
'resources/assets/css/demo.css',
'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss'
])

@yield('vendor-style')
@yield('page-style')