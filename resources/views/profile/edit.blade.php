@php
    $role = Auth::user()->role; 
    
    // WARNA DINAMIS: Peminjam = Emerald (#10b981), Admin/Petugas = Indigo (#4f46e5)
    $primaryColor = ($role == 'peminjam') ? 'emerald' : 'indigo';
    $primaryHex = ($role == 'peminjam') ? '#10b981' : '#4f46e5';

    // PATH PARTIALS: Menyesuaikan struktur folder kamu
    if ($role == 'admin') {
        $sidebar = 'partials.admin-sidebar';
        $navbar  = 'partials.navbar';
        $scripts = 'partials.admin-scripts';
    } else {
        $sidebar = $role . '.partials.sidebar';
        $navbar  = $role . '.partials.navbar';
        $scripts = $role . '.partials.scripts';
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body, html { 
            height: 100%; margin: 0; overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }
        .main-wrapper { display: flex; height: 100vh; width: 100%; }
        .sidebar-wrapper { height: 100vh; flex-shrink: 0; z-index: 50; }
        .content-area { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow-y: auto; scroll-behavior: smooth; }
        
        /* Premium Input Reset - Warna Focus Mengikuti Role */
        input[type="text"], input[type="email"], input[type="password"] {
            @apply block w-full rounded-2xl border-none bg-slate-50 py-4 px-6 transition-all duration-300 outline-none font-bold text-gray-800 text-[15px] mt-2 shadow-sm;
        }
        input:focus {
            box-shadow: 0 0 0 4px {{ $primaryHex }}1A;
            background-color: white !important;
        }

        label { @apply text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 block; }
        
        /* Tombol Save - Warna Mengikuti Role */
        button[type="submit"] {
            @apply relative px-10 py-4 text-white font-black rounded-2xl uppercase tracking-widest text-[11px] transition-all transform hover:-translate-y-1 active:scale-95 mt-6 flex items-center justify-center gap-3 overflow-hidden;
            background-color: {{ $primaryHex }};
            box-shadow: 0 20px 25px -5px {{ $primaryHex }}33;
        }
        
        button[type="submit"]:disabled { @apply opacity-70 cursor-not-allowed transform-none shadow-none; }

        /* Card Section - Radius Besar ala SIPRAS */
        .sipras-card { @apply bg-white p-10 md:p-12 rounded-[3.5rem] border border-slate-100 shadow-[0_20px_50px_rgba(0,0,0,0.02)] mb-10; }
        .section-title { @apply text-2xl font-black text-slate-900 tracking-tighter mb-1; }
        .section-desc { @apply text-sm text-slate-500 font-medium mb-10; }

        /* SweetAlert Customization */
        .sipras-swal-popup { border-radius: 2.5rem !important; padding: 2.5rem !important; font-family: 'Instrument Sans', sans-serif; }
        .sipras-swal-confirm { border-radius: 1.25rem !important; padding: 14px 40px !important; font-weight: 800 !important; text-transform: uppercase; font-size: 11px !important; background-color: {{ $primaryHex }} !important; }

        /* Hide Breeze Defaults */
        .text-sm.text-gray-600 { display: none !important; }

        /* Loader Animation */
        .loader {
            width: 14px; height: 14px; border: 2px solid #FFF; border-bottom-color: transparent; border-radius: 50%; display: none; animation: rotation 1s linear infinite;
        }
        @keyframes rotation { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include($sidebar)
    </div>

    <div class="content-area">
        @include($navbar)

        <main class="p-8 lg:p-14">
            <div class="max-w-7xl mx-auto">
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-14">
                    <div>
                        <div class="flex items-center gap-3 mb-2 text-{{ $primaryColor }}-600">
                            <span class="h-1.5 w-10 bg-{{ $primaryColor }}-600 rounded-full"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.4em]">Personal Settings</span>
                        </div>
                        <h1 class="text-5xl font-black text-slate-900 tracking-tighter">Pengaturan Akun</h1>
                    </div>
                    
                    <div class="flex items-center gap-5 bg-white px-8 py-5 rounded-[2rem] border border-slate-100 shadow-sm">
                        <div class="w-14 h-14 rounded-2xl bg-{{ $primaryColor }}-600 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-{{ $primaryColor }}-100 uppercase">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1.5">Role Level</p>
                            <span class="text-xs font-black text-slate-900 uppercase tracking-tighter italic px-3 py-1 bg-{{ $primaryColor }}-50 rounded-lg text-{{ $primaryColor }}-600">{{ $role }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <div class="lg:col-span-8">
                        <div class="sipras-card">
                            <h2 class="section-title">Informasi Profil</h2>
                            <p class="section-desc">Sesuaikan identitas akun Anda agar tetap akurat dalam sistem peminjaman.</p>
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div class="sipras-card">
                            <h2 class="section-title">Keamanan Password</h2>
                            <p class="section-desc">Gunakan kombinasi karakter yang unik untuk menjaga keamanan akses dashboard Anda.</p>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="lg:col-span-4 h-fit sticky top-12">
                        <div class="bg-{{ $primaryColor }}-600 p-12 rounded-[3.5rem] text-white shadow-2xl shadow-{{ $primaryColor }}-100 relative overflow-hidden flex flex-col items-center text-center">
                            <div class="absolute -right-16 -top-16 w-48 h-48 bg-white/10 rounded-full"></div>
                            <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-{{ $primaryColor }}-400/20 rounded-full"></div>

                            <div class="w-24 h-24 bg-white/15 backdrop-blur-md rounded-[2.5rem] flex items-center justify-center mb-8 shadow-inner">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            
                            <h3 class="text-3xl font-black tracking-tight mb-4">Pusat Keamanan</h3>
                            <p class="text-{{ $primaryColor }}-50 text-sm font-medium leading-relaxed mb-10 opacity-80 uppercase tracking-tight">
                                Data profil Anda bersifat personal. Perubahan akan segera disinkronkan ke seluruh modul SIPRAS secara real-time.
                            </p>
                            
                            <div class="w-12 h-1 bg-white/30 rounded-full mb-8"></div>
                            <span class="text-[10px] font-black uppercase tracking-[0.4em] px-6 py-2 bg-white/10 rounded-full">SIPRAS {{ strtoupper($role) }}</span>
                        </div>
                    </div>
                </div>

                <p class="text-center text-slate-300 text-[11px] mt-24 font-bold uppercase tracking-[0.6em]">
                    &copy; 2026 SIPRAS Traffic Control — V.2.0
                </p>
            </div>
        </main>
    </div>
</div>

@include($scripts)

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Sukses Update Alert
        @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
            Swal.fire({
                icon: 'success',
                title: 'Sinkronisasi Berhasil!',
                text: 'Perubahan Anda telah berhasil disimpan ke database.',
                confirmButtonText: 'OKE',
                confirmButtonColor: '{{ $primaryHex }}',
                customClass: {
                    popup: 'sipras-swal-popup',
                    confirmButton: 'sipras-swal-confirm'
                },
                buttonsStyling: false
            });
        @endif

        // 2. Error Alert
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Valid',
                text: 'Silakan periksa kembali inputan Anda.',
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#ef4444',
                customClass: {
                    popup: 'sipras-swal-popup',
                    confirmButton: 'sipras-swal-confirm'
                },
                buttonsStyling: false
            });
        @endif

        // 3. Efek Loading Submit
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const button = this.querySelector('button[type="submit"]');
                if (button) {
                    button.disabled = true;
                    button.innerHTML = `<span class="loader" style="display:inline-block"></span> <span>Memproses...</span>`;
                }
            });
        });
    });
</script>

</body>
</html>