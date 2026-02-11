<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - SIPRAS</title>
    
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

        /* Sidebar Wrapper tetap diam di posisi kiri */
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
        
        .form-input-custom {
            transition: all 0.3s ease;
        }
        .form-input-custom:focus {
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
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

        <main class="p-8 lg:p-12 flex flex-col items-center">
            
            <div class="w-full max-w-2xl mb-10 text-center lg:text-left lg:flex lg:items-center lg:justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2 justify-center lg:justify-start">
                        <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em]">Modifikasi Data</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Edit User</h1>
                    <p class="text-gray-500 font-medium mt-1">Memperbarui informasi akun <span class="text-blue-600 font-bold">{{ $user->name }}</span>.</p>
                </div>
            </div>

            <div class="w-full max-w-2xl bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden mb-12">
                <div class="p-8 lg:p-12">
                    <form method="POST" 
                          action="{{ route('admin.users.update', $user->id) }}" 
                          class="form-confirm space-y-6" 
                          data-message="Yakin ingin memperbarui user ini?">
                        @csrf
                        @method('PUT')

                        <div class="space-y-2">
                            <label class="text-sm font-black text-gray-700 ml-1 uppercase tracking-widest text-[10px]">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </span>
                                <input type="text" name="name" value="{{ $user->name }}" required 
                                    class="form-input-custom w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-black text-gray-700 ml-1 uppercase tracking-widest text-[10px]">Alamat Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </span>
                                <input type="email" name="email" value="{{ $user->email }}" required 
                                    class="form-input-custom w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center ml-1">
                                <label class="text-sm font-black text-gray-700 uppercase tracking-widest text-[10px]">Kata Sandi</label>
                                <span class="text-[9px] font-bold text-orange-500 uppercase tracking-tighter bg-orange-50 px-2 py-0.5 rounded-md italic">Kosongkan jika tidak diubah</span>
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </span>
                                <input type="password" name="password" 
                                    class="form-input-custom w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800 placeholder:text-gray-300 placeholder:font-medium"
                                    placeholder="Isi hanya jika ingin ganti password...">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-black text-gray-700 ml-1 uppercase tracking-widest text-[10px]">Hak Akses (Role)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </span>
                                <select name="role" required 
                                    class="form-input-custom w-full pl-11 pr-10 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800 appearance-none cursor-pointer">
                                    <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                </span>
                            </div>
                        </div>

                        <div class="pt-6 flex flex-col sm:flex-row gap-4">
                            <button type="submit" 
                                class="flex-1 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-xs">
                                Perbarui Data
                            </button>
                            <a href="{{ route('admin.users.index') }}" 
                               class="flex-1 py-4 bg-white hover:bg-gray-50 text-gray-400 font-bold rounded-2xl text-center transition-all uppercase tracking-widest text-xs border border-gray-100">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-gray-300 text-[10px] mt-4 font-bold uppercase tracking-widest">
                SIPRAS Database Maintenance &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('partials.admin-scripts')
</body>
</html>