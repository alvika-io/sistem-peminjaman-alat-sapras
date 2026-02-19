<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, Indonesian">
    <title>Laporan Pengembalian - SIPRAS Petugas</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

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
        
        .sipras-table thead th {
            background-color: #f1f5f9;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            font-weight: 800;
            padding: 1.25rem 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .sipras-table tbody tr { transition: all 0.2s; border-bottom: 1px solid #f1f5f9; }
        .sipras-table tbody tr:hover { background-color: #f8fafc; }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('petugas.partials.sidebar')
    </div>

    <div class="content-area">
        @include('petugas.partials.navbar')

        <main class="p-8 lg:p-12">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2 text-indigo-600">
                    <span class="h-1 w-8 bg-indigo-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Reporting System</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Laporan Pengembalian</h1>
                <p class="text-gray-500 font-medium mt-1">Rekapitulasi data pengembalian dan denda dalam periode tertentu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Total Laporan</p>
                    <h3 class="text-2xl font-black text-gray-900">{{ $pengembalians->count() }} <span class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Data</span></h3>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Denda Cair</p>
                    <h3 class="text-2xl font-black text-green-600">Rp {{ number_format($stats['total_lunas'], 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Piutang Denda</p>
                    <h3 class="text-2xl font-black text-orange-500">Rp {{ number_format($stats['total_piutang'], 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alat Rusak/Hilang</p>
                    <h3 class="text-2xl font-black text-red-500">{{ $stats['total_rusak'] + $stats['total_hilang'] }} <span class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Unit</span></h3>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-8">
                <form method="GET" action="{{ route('petugas.laporan.pengembalian') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" 
                            class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none focus:ring-2 focus:ring-indigo-100 transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" 
                            class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none focus:ring-2 focus:ring-indigo-100 transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kondisi Alat</label>
                        <select name="kondisi" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none focus:ring-2 focus:ring-indigo-100 transition-all appearance-none">
                            <option value="">Semua Kondisi</option>
                            <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak" {{ request('kondisi') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="hilang" {{ request('kondisi') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl shadow-lg shadow-indigo-100 transition-all text-sm uppercase tracking-widest">
                            Filter
                        </button>
                        <a href="{{ route('petugas.laporan.pengembalian.cetak', request()->all()) }}" 
                           class="btn-cetak-pdf px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-black rounded-xl shadow-lg shadow-green-100 transition-all text-sm uppercase tracking-widest flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H7a2 2 0 00-2 2v4h12z"/></svg>
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.02)] border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto p-8">
                    <table class="w-full text-left sipras-table">
                        <thead>
                            <tr>
                                <th class="w-12 text-center">No</th>
                                <th>Nama Peminjam</th>
                                <th>Alat & Kondisi</th>
                                <th>Tanggal Kembali</th>
                                <th class="text-right pr-8">Denda & Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @forelse ($pengembalians as $item)
                            <tr>
                                <td class="py-5 text-center font-bold text-gray-400">{{ $loop->iteration }}</td>
                                <td class="py-5">
                                    <div class="font-bold text-gray-900">{{ $item->peminjaman->user->name }}</div>
                                    <div class="text-[10px] text-gray-400 uppercase font-black">#RTN-{{ $item->id }}</div>
                                </td>
                                <td class="py-5">
                                    <div class="flex flex-wrap gap-1 mb-1">
                                        @foreach($item->peminjaman->alats as $alat)
                                            <span class="text-[9px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-bold uppercase">{{ $alat->nama }}</span>
                                        @endforeach
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $item->kondisi == 'baik' ? 'text-green-500' : 'text-red-500' }}">
                                        • {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="py-5 font-mono text-xs uppercase">{{ \Carbon\Carbon::parse($item->tanggal_kembali_real)->format('d/m/Y') }}</td>
                                <td class="py-5 text-right pr-8">
                                    <div class="font-black {{ $item->denda > 0 ? 'text-red-500' : 'text-gray-300' }}">
                                        Rp {{ number_format($item->denda, 0, ',', '.') }}
                                    </div>
                                    <div class="text-[9px] font-black uppercase tracking-tighter {{ $item->denda_status == 'lunas' ? 'text-green-500' : 'text-orange-400' }}">
                                        {{ $item->denda_status }}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center text-gray-300 font-bold uppercase tracking-widest italic">
                                    Data pengembalian tidak ditemukan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-indigo-600 p-8 flex items-center justify-between text-white">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Omzet Denda Periode Ini</p>
                            <h3 class="text-2xl font-black tracking-tighter italic">Akumulasi Total</h3>
                        </div>
                    </div>
                    <div class="text-right">
                        <h3 class="text-4xl font-black tracking-tighter">Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            
            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest">
                SIPRAS Reporting Engine &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('petugas.partials.scripts')

<script>
    $(document).on('click', '.btn-cetak-pdf', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');

        Swal.fire({
            title: 'Konfirmasi Cetak',
            text: 'Dokumen laporan akan segera dibuat dalam format PDF',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: '<span class="text-white font-bold">Ya, Cetak!</span>',
            cancelButtonText: '<span class="text-gray-500 font-bold">Batal</span>',
            customClass: {
                popup: 'rounded-[2rem]',
                confirmButton: 'rounded-xl px-6 py-3',
                cancelButton: 'rounded-xl px-6 py-3'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>

</body>
</html>