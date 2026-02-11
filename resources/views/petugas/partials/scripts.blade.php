{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<style>
    /* UPGRADE DATA TABLES UI PETUGAS (INDIGO THEME) */
    .dataTables_wrapper .dataTables_length select {
        border-radius: 12px;
        padding: 5px 10px;
        border-color: #f1f5f9;
        font-weight: 700;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 14px;
        padding: 8px 15px;
        border: 1px solid #f1f5f9;
        background-color: #f8fafc;
        margin-left: 10px;
        outline: none;
        font-weight: 600;
    }
    table.dataTable.no-footer { border-bottom: 1px solid #f1f5f9 !important; }
    .dataTables_wrapper .dataTables_info { font-size: 11px; font-weight: 700; color: #94a3b8 !important; text-transform: uppercase; letter-spacing: 0.05em; padding-top: 20px; }
    
    /* Pagination Indigo Styling */
    .dataTables_wrapper .dataTables_paginate { padding-top: 20px; }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 12px !important;
        border: none !important;
        font-weight: 800 !important;
        font-size: 11px !important;
        text-transform: uppercase;
        padding: 8px 16px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important; /* Indigo-600 */
        color: white !important;
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f1f5f9 !important;
        color: #4f46e5 !important;
    }

    /* SWEETALERT PREMIUM RADIUS (MATCH PETUGAS UI) */
    .sipras-swal-popup { border-radius: 2.5rem !important; padding: 2.5rem !important; }
    .sipras-swal-confirm { border-radius: 1.25rem !important; padding: 14px 40px !important; font-weight: 800 !important; text-transform: uppercase; font-size: 11px !important; letter-spacing: 0.1em !important; margin: 5px !important; }
    .sipras-swal-cancel { border-radius: 1.25rem !important; padding: 14px 40px !important; font-weight: 800 !important; text-transform: uppercase; font-size: 11px !important; letter-spacing: 0.1em !important; background-color: #f1f5f9 !important; color: #64748b !important; margin: 5px !important; }
</style>

<script>
    $(document).ready(function () {
        // ==========================
        // MODERN DATATABLES (PETUGAS VERSION)
        // ==========================
        $('.datatable').DataTable({
            pageLength: 10,
            lengthChange: true,
            ordering: true,
            searching: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari data transaksi...",
                lengthMenu: "_MENU_",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "<svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path d='M15 19l-7-7 7-7' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'/></svg>",
                    next: "<svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path d='M9 5l7 7-7 7' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'/></svg>"
                }
            }
        });

        // Mixin Konfigurasi SweetAlert Sipras Petugas
        const SiprasAlert = Swal.mixin({
            customClass: {
                popup: 'sipras-swal-popup',
                confirmButton: 'sipras-swal-confirm',
                cancelButton: 'sipras-swal-cancel'
            },
            buttonsStyling: false
        });

        // ==========================
        // FLASH MESSAGE (SUCCESS / ERROR)
        // ==========================
        @if (session('success'))
            SiprasAlert.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false,
                iconColor: '#4f46e5'
            });
        @endif

        @if (session('error'))
            SiprasAlert.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#ef4444'
            });
        @endif

        // ==========================
        // KONFIRMASI HAPUS
        // ==========================
        $(document).on('submit', '.form-delete', function (e) {
            e.preventDefault();
            let form = this;

            SiprasAlert.fire({
                title: 'Hapus Transaksi?',
                text: 'Data yang dihapus tidak bisa dikembalikan ke sistem.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ef4444'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // ==========================
        // KONFIRMASI UMUM (Validasi / Verifikasi)
        // ==========================
        $(document).on('submit', '.form-confirm', function (e) {
            e.preventDefault();
            let form = this;
            let message = $(this).data('message') ?? 'Yakin ingin memproses data ini?';

            SiprasAlert.fire({
                title: 'Konfirmasi Petugas',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Proses',
                cancelButtonText: 'Periksa Lagi',
                confirmButtonColor: '#4f46e5'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>