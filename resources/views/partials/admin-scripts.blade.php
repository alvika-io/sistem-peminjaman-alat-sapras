{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
    // DataTables otomatis
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

    // ==========================
    // FLASH MESSAGE (SUCCESS / ERROR)
    // ==========================
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
        });
    @endif

    // ==========================
    // KONFIRMASI HAPUS
    // ==========================
    $(document).on('submit', '.form-delete', function (e) {
        e.preventDefault();
        let form = this;

        Swal.fire({
            title: 'Yakin?',
            text: 'Data ini akan dihapus dan tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // ==========================
    // KONFIRMASI SIMPAN / UPDATE
    // ==========================
    $(document).on('submit', '.form-confirm', function (e) {
        e.preventDefault();
        let form = this;
        let message = $(this).data('message') ?? 'Yakin melanjutkan aksi ini?';

        Swal.fire({
            title: 'Konfirmasi',
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
