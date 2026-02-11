<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        /* Mencegah scroll di body utama agar sidebar tidak ikut terangkat */
        body, html { 
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }

        /* Wrapper utama setinggi layar penuh */
        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        /* Sidebar Wrapper tetap diam di kiri */
        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        /* Area konten yang bisa di-scroll secara mandiri */
        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }
        
        /* Custom Table Styling */
        .sipras-table thead th {
            background-color: #f1f5f9;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            font-weight: 800;
            padding: 1.25rem 1rem;
            position: sticky; /* Judul kolom juga nempel saat scroll */
            top: 0;
            z-index: 10;
        }
        .sipras-table tbody tr {
            transition: all 0.2s;
            border-bottom: 1px solid #f1f5f9;
        }
        .sipras-table tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('partials.admin-sidebar')
    </div>

    <div class="content-area">
        @include('partials.navbar')

        <main class="p-8 lg:p-12">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em]">Manajemen Akun</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Data User</h1>
                    <p class="text-gray-500 font-medium mt-1">Kelola hak akses dan informasi pengguna sistem.</p>
                </div>

                <a href="{{ route('admin.users.create') }}" 
                    class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah User Baru</span>
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between px-8 py-6">
                    <h3 class="font-black text-gray-800 tracking-tight">Daftar Pengguna</h3>
                    <span class="bg-white border border-gray-200 text-gray-400 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest">Total: {{ count($users) }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse sipras-table">
                        <thead>
                            <tr>
                                <th class="pl-8">Nama Lengkap</th>
                                <th>Alamat Email</th>
                                <th>Role Akses</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @foreach ($users as $user)
                            <tr>
                                <td class="pl-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-black text-xs">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <span class="text-gray-900 font-bold tracking-tight">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-5 font-mono text-xs text-gray-400">{{ $user->email }}</td>
                                <td class="py-5">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $user->role == 'admin' ? 'bg-purple-50 text-purple-600' : 'bg-blue-50 text-blue-600' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="py-5 text-center px-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="p-2.5 bg-gray-50 text-gray-400 hover:bg-blue-600 hover:text-white rounded-xl transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                              method="POST" 
                                              class="form-delete inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2.5 bg-gray-50 text-gray-400 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest">
                SIPRAS Database &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('partials.admin-scripts')
</body>
</html>