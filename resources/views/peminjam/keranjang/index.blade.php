<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Peminjaman - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <style>
        body, html { 
            height: 100%; margin: 0; overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }
        .main-wrapper { display: flex; height: 100vh; width: 100%; }
        .sidebar-wrapper { height: 100vh; flex-shrink: 0; z-index: 50; }
        .content-area { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow-y: auto; }
        
        /* Checkbox Logic */
        .select-item-checkbox:checked + .card-label {
            border-color: #10b981 !important;
            background-color: #f0fdf4;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.1);
        }

        .select-item-checkbox:checked + .card-label .checkbox-box {
            background-color: #10b981;
            border-color: #10b981;
        }

        .select-item-checkbox:checked + .card-label .checkbox-icon {
            opacity: 1;
            transform: scale(1);
        }

        .checkbox-box { transition: all 0.2s ease; }
        .checkbox-icon {
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .form-input-custom { transition: all 0.3s ease; border: 1px solid #f1f5f9; }
        .form-input-custom:focus { border-color: #10b981; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
        
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
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
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2 text-emerald-600">
                        <span class="h-1 w-8 bg-emerald-600 rounded-full"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">Selection Mode</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Pilih Alat</h1>
                    <p class="text-gray-500 font-medium mt-1 text-sm">Centang kartu alat yang ingin diajukan peminjaman sekarang.</p>
                </div>
                
                <a href="{{ route('peminjam.peminjaman.create') }}" 
                   class="flex items-center gap-2 px-6 py-4 bg-white border-2 border-emerald-100 text-emerald-600 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-50 hover:border-emerald-200 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Alat Lagi
                </a>
            </div>

            @if($items->isEmpty())
                <div class="bg-white p-20 rounded-[3rem] border border-dashed border-gray-200 text-center">
                    <div class="w-20 h-20 bg-emerald-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 118 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Keranjang masih kosong</h3>
                    <p class="text-gray-400 text-sm mt-2 mb-8">Mungkin kamu belum sempat memilih alat sapras yang ingin dipinjam.</p>
                    <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-block px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl uppercase text-[10px] tracking-widest hover:bg-emerald-700 transition-all shadow-lg">Cari Alat Sekarang</a>
                </div>
            @else
                <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" id="form-checkout">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-4">
                            <div class="flex justify-between items-center px-4 mb-2">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Daftar Item</span>
                                <button type="button" onclick="toggleSelectAll()" id="btn-select-all" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Pilih Semua</button>
                            </div>

                            @foreach($items as $index => $item)
                                <div class="relative group">
                                    <input type="checkbox" id="check{{ $index }}" 
                                           class="select-item-checkbox absolute opacity-0 w-0 h-0" 
                                           onchange="updateSelection({{ $index }})">
                                    
                                    <label for="check{{ $index }}" class="card-label flex flex-col md:flex-row md:items-center justify-between p-6 bg-white border-2 border-transparent rounded-[2.5rem] transition-all duration-300 shadow-sm cursor-pointer relative z-0">
                                        
                                        <div class="flex items-center gap-5">
                                            <div class="checkbox-box w-6 h-6 border-2 border-gray-200 rounded-lg flex items-center justify-center flex-shrink-0 transition-all bg-white">
                                                <svg class="checkbox-icon w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>

                                            <div class="w-20 h-20 rounded-2xl bg-gray-50 overflow-hidden flex-shrink-0 border border-gray-100">
                                                @if($item->alat->gambar)
                                                    <img src="{{ asset('storage/' . $item->alat->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-emerald-50 text-emerald-600 font-black text-xl">{{ substr($item->alat->nama, 0, 1) }}</div>
                                                @endif
                                            </div>
                                            
                                            <div class="relative z-20">
                                                <h4 class="font-black text-gray-900 leading-tight text-lg">{{ $item->alat->nama }}</h4>
                                                
                                                <div class="flex items-center gap-3 mt-3 relative z-30 pointer-events-auto" onclick="event.preventDefault(); event.stopPropagation();">
                                                    <button type="button" 
                                                        onclick="changeQty({{ $index }}, -1, {{ $item->alat->stok_tersedia ?? 0 }}, {{ $item->alat->id }}); event.stopPropagation();" 
                                                        class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-red-100 hover:text-red-600 transition-all active:scale-90">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"/></svg>
                                                    </button>
                                                    
                                                    <input type="number" id="display-qty-{{ $index }}" value="{{ $item->jumlah }}" readonly
                                                           class="w-8 text-center bg-transparent border-none font-black text-sm text-gray-800 p-0 focus:ring-0">

                                                    <button type="button" 
                                                        onclick="changeQty({{ $index }}, 1, {{ $item->alat->stok_tersedia ?? 0 }}, {{ $item->alat->id }}); event.stopPropagation();" 
                                                        class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white hover:bg-emerald-700 transition-all shadow-md active:scale-90">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                                                    </button>
                                                    
                                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">STOK: {{ $item->alat->stok_tersedia ?? 0 }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-end md:justify-center gap-4 mt-4 md:mt-0 relative z-30 pointer-events-auto" onclick="event.preventDefault(); event.stopPropagation();">
                                            <input type="hidden" name="alat_id[]" value="{{ $item->alat->id }}" id="input-alat-{{ $index }}" disabled>
                                            <input type="hidden" name="jumlah[]" value="{{ $item->jumlah }}" id="input-jumlah-{{ $index }}" disabled>

                                            <button type="button" onclick="konfirmasiHapusKeranjang({{ $item->id }}); event.stopPropagation();" class="p-3 bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 sticky top-8">
                                <h3 class="text-xs font-black text-emerald-600 uppercase tracking-widest mb-6 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"/></svg>
                                    Jadwal Pinjam
                                </h3>
                                
                                <div class="space-y-4">
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Pinjam</label>
                                        <input type="text" id="tanggal_pinjam" name="tanggal_pinjam" placeholder="Pilih Tanggal Pinjam" required
                                               class="form-input-custom w-full px-5 py-4 bg-gray-50 rounded-2xl outline-none font-bold text-gray-800 cursor-pointer text-sm">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Kembali</label>
                                        <input type="text" id="tanggal_kembali" name="tanggal_kembali" placeholder="Pilih Tanggal Kembali" required
                                               class="form-input-custom w-full px-5 py-4 bg-gray-50 rounded-2xl outline-none font-bold text-gray-800 cursor-pointer text-sm">
                                    </div>
                                </div>

                                <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                                    <button type="submit" id="btn-submit" disabled class="w-full py-5 bg-gray-200 text-gray-400 font-black rounded-[2rem] uppercase tracking-widest text-[10px] transition-all cursor-not-allowed">
                                        Ajukan Peminjaman
                                    </button>
                                    <p id="submit-hint" class="text-[9px] text-gray-400 mt-4 font-bold uppercase tracking-widest">Pilih minimal 1 alat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </main>
    </div>
</div>

<form id="form-delete" action="" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@include('peminjam.partials.scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
    function changeQty(index, delta, stok, alatId) {
        const displayInput = document.getElementById('display-qty-' + index);
        const hiddenInput = document.getElementById('input-jumlah-' + index);
        
        if (!displayInput) return;

        let currentVal = parseInt(displayInput.value);
        let newVal = currentVal + delta;

        if (newVal >= 1 && newVal <= stok) {
            displayInput.value = newVal;
            if (hiddenInput) hiddenInput.value = newVal;

            fetch("{{ route('peminjam.keranjang.update-quantity') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    alat_id: alatId,
                    jumlah: newVal
                })
            })
            .then(response => response.json())
            .catch(err => console.error("Update quantity failed:", err));

        } else if (newVal > stok) {
            alert('Stok hanya tersedia ' + stok + ' unit.');
        }
    }

    function updateSelection(index) {
        const checkbox = document.getElementById('check' + index);
        const inputAlat = document.getElementById('input-alat-' + index);
        const inputJumlah = document.getElementById('input-jumlah-' + index);
        const btnSubmit = document.getElementById('btn-submit');
        const hint = document.getElementById('submit-hint');

        if (checkbox.checked) {
            inputAlat.disabled = false;
            inputJumlah.disabled = false;
        } else {
            inputAlat.disabled = true;
            inputJumlah.disabled = true;
        }

        const checkedCount = document.querySelectorAll('.select-item-checkbox:checked').length;
        if (checkedCount > 0) {
            btnSubmit.disabled = false;
            btnSubmit.classList.remove('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
            btnSubmit.classList.add('bg-emerald-600', 'text-white');
            hint.innerText = checkedCount + " Item terpilih";
        } else {
            btnSubmit.disabled = true;
            btnSubmit.classList.add('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
            btnSubmit.classList.remove('bg-emerald-600', 'text-white');
            hint.innerText = "Pilih minimal 1 alat";
        }
    }

    function toggleSelectAll() {
        const checkboxes = document.querySelectorAll('.select-item-checkbox');
        const btn = document.getElementById('btn-select-all');
        const isAllSelected = Array.from(checkboxes).every(c => c.checked);

        checkboxes.forEach((c, index) => {
            c.checked = !isAllSelected;
            updateSelection(index);
        });

        btn.innerText = isAllSelected ? 'PILIH SEMUA' : 'BATAL SEMUA';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const commonConfig = { locale: "id", altInput: true, altFormat: "d F Y", dateFormat: "Y-m-d", minDate: "today", static: true };
        const pinjamPicker = flatpickr("#tanggal_pinjam", {
            ...commonConfig,
            onChange: function(selectedDates, dateStr) {
                if (typeof kembaliPicker !== 'undefined') { kembaliPicker.set('minDate', dateStr); }
            }
        });
        const kembaliPicker = flatpickr("#tanggal_kembali", { ...commonConfig });
    });
</script>

</body>
</html>