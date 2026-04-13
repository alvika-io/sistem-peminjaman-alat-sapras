<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Peminjaman - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body, html { 
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }

        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }
        
        .form-input-custom { transition: all 0.3s ease; border: 1px solid #f1f5f9; }
        .form-input-custom:focus { border-color: #10b981; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
        
        .tool-card-checkbox:checked + label { 
            border-color: #10b981; 
            background-color: #f0fdf4; 
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.1);
        }

        .flatpickr-day.selected { background: #10b981 !important; border-color: #10b981 !important; }
        .flatpickr-calendar {
            border-radius: 1.5rem !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #f1f5f9 !important;
        }

        /* Floating Cart Animation */
        .cart-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('peminjam.partials.sidebar')
    </div>

    <div class="content-area">
        @include('peminjam.partials.navbar')

        <main class="p-8 lg:p-12">
            <div class="mb-10 text-center lg:text-left flex justify-between items-end">
                <div>
                    <div class="flex items-center gap-3 mb-2 justify-center lg:justify-start text-emerald-600">
                        <span class="h-1 w-8 bg-emerald-600 rounded-full"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">New Request</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Ajukan Peminjaman</h1>
                    <p class="text-gray-500 font-medium mt-1 text-sm text-balance">Lengkapi detail peminjaman atau simpan alat ke keranjang untuk nanti.</p>
                </div>
            </div>

            <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" class="form-confirm space-y-8 pb-12">
                @csrf

                <div class="bg-white p-8 lg:p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(16,185,129,0.02)] border border-gray-100">
                    <h3 class="text-xs font-black text-emerald-600 uppercase tracking-widest mb-8 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Tentukan Jadwal
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Tanggal Pinjam</label>
                            <div class="relative flatpickr-wrapper">
                                <input type="text" id="tanggal_pinjam" name="tanggal_pinjam" placeholder="Pilih Tanggal Pinjam" required
                                    class="form-input-custom w-full px-5 py-4 bg-gray-50 rounded-2xl outline-none font-bold text-gray-800 cursor-pointer">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Tanggal Kembali</label>
                            <div class="relative flatpickr-wrapper">
                                <input type="text" id="tanggal_kembali" name="tanggal_kembali" placeholder="Pilih Tanggal Kembali" required
                                    class="form-input-custom w-full px-5 py-4 bg-gray-50 rounded-2xl outline-none font-bold text-gray-800 cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 lg:p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(16,185,129,0.02)] border border-gray-100">
                    <h3 class="text-xs font-black text-emerald-600 uppercase tracking-widest mb-8 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                        Pilih Alat Sapras
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($alats as $index => $alat)
                        <div class="relative group">
                            <input type="checkbox" name="alat_id[]" value="{{ $alat->id }}" id="alat{{ $alat->id }}" 
                                   class="tool-card-checkbox hidden peer" onchange="toggleQty(this, {{ $index }})">
                            <label for="alat{{ $alat->id }}" class="flex items-center justify-between p-5 bg-gray-50 border-2 border-transparent rounded-3xl cursor-pointer transition-all duration-300 hover:border-emerald-200">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-white border border-gray-100 overflow-hidden flex-shrink-0 shadow-sm">
                                        @if($alat->gambar)
                                            <img src="{{ asset('storage/' . $alat->gambar) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-emerald-50 text-emerald-600 font-black text-xs uppercase">{{ substr($alat->nama, 0, 1) }}</div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-gray-900 tracking-tight">{{ $alat->nama }}</span>
                                        <span class="text-[9px] font-bold text-gray-400 uppercase">Stok: {{ $alat->stok_tersedia }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="number" name="jumlah[]" id="qty{{ $index }}" min="1" max="{{ $alat->stok_tersedia }}" 
                                           placeholder="0" disabled
                                           class="w-14 px-2 py-2 bg-white border border-gray-200 rounded-xl outline-none focus:border-emerald-500 font-bold text-center text-xs disabled:opacity-30 transition-all">
                                    
                                    <button type="button" onclick="simpanKeKeranjang({{ $alat->id }}, {{ $index }}, event)" 
                                            class="p-2.5 bg-white border border-gray-100 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit" class="flex-1 py-5 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-3xl shadow-xl transition-all uppercase tracking-[0.2em] text-xs transform hover:-translate-y-1">Kirim Pengajuan Langsung</button>
                    <a href="{{ route('peminjam.peminjaman.index') }}" class="flex-1 py-5 bg-white text-gray-400 font-bold rounded-3xl text-center border border-gray-100 uppercase tracking-widest text-xs transition-all hover:bg-gray-50">Batal</a>
                </div>
            </form>

            <p class="text-center text-gray-300 text-[10px] mt-4 font-bold uppercase tracking-widest leading-loose">
                SIPRAS Member Portal &copy; 2026
            </p>
        </main>

        <a href="{{ route('peminjam.keranjang.index') }}" class="fixed bottom-10 right-10 z-[60] cart-float group">
            <div class="bg-white p-5 rounded-[2rem] shadow-[0_20px_50px_rgba(16,185,129,0.2)] border border-emerald-50 flex items-center gap-4 transition-all group-hover:pr-8">
                <div class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 118 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Cek Alat</span>
                    <span class="text-sm font-black text-gray-900 tracking-tighter">Keranjang Saya</span>
                </div>
            </div>
        </a>
    </div>
</div>

@include('peminjam.partials.scripts')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script> 
<script>
    function toggleQty(checkbox, index) {
        const qtyInput = document.getElementById('qty' + index);
        qtyInput.disabled = !checkbox.checked;
        if (checkbox.checked) {
            qtyInput.focus();
            qtyInput.value = 1;
        } else {
            qtyInput.value = '';
        }
    }

    // Fungsi Simpan ke Keranjang AJAX dengan SweetAlert Premium
    function simpanKeKeranjang(alatId, index, event) {
        event.preventDefault(); 
        
        const qtyInput = document.getElementById('qty' + index);
        const jumlah = qtyInput.value;

        if (!jumlah || jumlah < 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Ops...',
                text: 'Silahkan tentukan jumlah alat terlebih dahulu!',
                confirmButtonColor: '#10b981',
                customClass: { popup: 'sipras-swal-popup' }
            });
            qtyInput.focus();
            return;
        }

        const btn = event.currentTarget;
        const originalIcon = btn.innerHTML;
        btn.innerHTML = `<svg class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83" stroke-width="2" stroke-linecap="round"/></svg>`;
        btn.disabled = true;

        fetch("{{ route('peminjam.keranjang.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                alat_id: alatId,
                jumlah: jumlah
            })
        })
        .then(response => response.json())
        .then(data => {
            // Memanggil fungsi notifikasi modern dari partials/scripts
            if (typeof tampilkanNotifKeranjang === "function") {
                tampilkanNotifKeranjang();
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Alat berhasil masuk keranjang!',
                    timer: 2000,
                    showConfirmButton: false,
                    iconColor: '#10b981',
                    customClass: { popup: 'sipras-swal-popup' }
                });
            }
            
            // Reset input
            qtyInput.value = '';
            qtyInput.disabled = true;
            document.getElementById('alat' + alatId).checked = false;
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat menyimpan ke keranjang.',
                confirmButtonColor: '#10b981',
                customClass: { popup: 'sipras-swal-popup' }
            });
        })
        .finally(() => {
            btn.innerHTML = originalIcon;
            btn.disabled = false;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const commonConfig = {
            locale: "id",
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            static: true,
        };

        const pinjamPicker = flatpickr("#tanggal_pinjam", {
            ...commonConfig,
            onChange: function(selectedDates, dateStr) {
                if (typeof kembaliPicker !== 'undefined') {
                    kembaliPicker.set('minDate', dateStr);
                }
            }
        });

        const kembaliPicker = flatpickr("#tanggal_kembali", {
            ...commonConfig,
        });
    });
</script>

</body>
</html>