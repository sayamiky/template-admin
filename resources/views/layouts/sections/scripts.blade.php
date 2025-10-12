<!-- ===============================
     Core JS
================================ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@vite([
'resources/assets/js/pages-account-settings-account.js',
'resources/assets/vendor/libs/popper/popper.js',
'resources/assets/vendor/js/bootstrap.js',
'resources/assets/vendor/libs/node-waves/node-waves.js',
'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
'resources/assets/vendor/js/helpers.js',
'resources/assets/vendor/js/menu.js',
'resources/assets/js/config.js',
])


<!-- ===============================
     DataTables JS
================================ -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- ===============================
     Vendor & Page Script Slots
================================ -->
@yield('vendor-script')

<!-- ===============================
     Main App JS (hanya sekali!)
================================ -->
@vite(['resources/assets/js/main.js'])

@stack('pricing-script')
@yield('page-script')
@stack('scripts')