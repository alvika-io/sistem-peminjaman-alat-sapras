<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, Indonesian">
    <title>Laporan Pengembalian - SIPRAS Petugas</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        /* Mencegah scroll di body utama agar sidebar tidak ikut tergulung */
        body, html { 
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }

        /* Wrapper utama setinggi layar monitor */
        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        /* Sidebar Wrapper tetap di posisi kiri */
        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        /* Area konten dengan scroll mandiri */
        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }
        
        /* Table Style Consistent with SIPRAS */
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

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-8">
                <form method="GET" action="{{ route('petugas.laporan.pengembalian') }}" class="flex flex-wrap items-end gap-6">
                    <div class="flex-1 min-w-[180px] space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" required 
                            class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none focus:ring-2 focus:ring-indigo-100 transition-all">
                    </div>

                    <div class="flex-1 min-w-[180px] space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" required 
                            class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none focus:ring-2 focus:ring-indigo-100 transition-all">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl shadow-lg shadow-indigo-100 transition-all text-sm uppercase tracking-widest">
                            Filter
                        </button>
                        <a href="{{ route('petugas.laporan.pengembalian.cetak', request()->all()) }}" 
                           class="btn-cetak-pdf px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-black rounded-xl shadow-lg shadow-green-100 transition-all text-sm uppercase tracking-widest flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H7a2 2 0 00-2 2v4h12z"/></svg>
                            Cetak PDF
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.02)] border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto p-8">
                    <table class="w-full text-left sipras-table datatable">
                        <thead>
                            <tr>
                                <th class="w-12 text-center">No</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Kembali Real</th>
                                <th class="text-right pr-8">Jumlah Denda</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @forelse ($pengembalians as $item)
                            <tr>
                                <td class="py-5 text-center font-bold text-gray-400">{{ $loop->iteration }}</td>
                                <td class="py-5 font-bold text-gray-900">{{ $item->peminjaman->user->name }}</td>
                                <td class="py-5 font-mono text-xs uppercase">{{ $item->tanggal_kembali_real }}</td>
                                <td class="py-5 text-right pr-8 font-black {{ $item->denda > 0 ? 'text-red-500' : 'text-gray-300' }}">
                                    Rp {{ number_format($item->denda, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center text-gray-300 font-bold uppercase tracking-widest italic">
                                    Data pengembalian tidak ditemukan dalam periode ini
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
                            <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Akumulasi Pendapatan Denda</p>
                            <h3 class="text-2xl font-black tracking-tighter italic">Total Denda</h3>
                        </div>
                    </div>
                    <div class="text-right">
                        <h3 class="text-4xl font-black tracking-tighter">Rp {{ number_format($totalDenda, 0, ',', '.') }}</h3>
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