<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-guest-layout>
    <style>
        /* Hilangkan elemen bawaan yang mengganggu */
        .min-h-screen > div:first-child svg, nav { display: none !important; }
        
        body { font-family: 'Instrument Sans', sans-serif; }

        .min-h-screen { 
            background-color: #f8fafc !important; 
            display: flex !important; 
            flex-direction: column !important;
            align-items: center !important; 
            justify-content: center !important; 
        }

        .w-full.sm:max-w-md {
            box-shadow: none !important;
            background: transparent !important;
            border: none !important;
        }

        /* SweetAlert Premium Radius */
        .sipras-swal-popup { border-radius: 2.5rem !important; padding: 2.5rem !important; font-family: 'Instrument Sans', sans-serif; }
        .sipras-swal-confirm { border-radius: 1.25rem !important; padding: 14px 40px !important; font-weight: 800 !important; text-transform: uppercase; font-size: 11px !important; letter-spacing: 0.1em !important; margin: 5px !important; }
        .sipras-swal-cancel { border-radius: 1.25rem !important; padding: 14px 40px !important; font-weight: 800 !important; text-transform: uppercase; font-size: 11px !important; letter-spacing: 0.1em !important; background-color: #f1f5f9 !important; color: #64748b !important; margin: 5px !important; }
    </style>

    <div class="w-full max-w-md mx-auto bg-white p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(59,130,246,0.12)] border border-gray-50">
        
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center bg-blue-600 w-20 h-20 rounded-3xl shadow-xl shadow-blue-100 mb-5 mx-auto transition-transform hover:rotate-6 duration-300">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h2 class="text-4xl font-black text-gray-900 tracking-tighter">SIPRAS</h2>
            <div class="flex items-center justify-center gap-2 mt-2">
                <span class="h-1 w-5 bg-blue-600 rounded-full"></span>
                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">Management System</p>
                <span class="h-1 w-5 bg-blue-600 rounded-full"></span>
            </div>
        </div>

        <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="block w-full rounded-2xl border-gray-100 bg-gray-50 py-4 pl-12 pr-5 focus:ring-4 focus:ring-blue-50 focus:border-blue-500 focus:bg-white shadow-sm transition-all duration-200 outline-none font-bold text-gray-800"
                        placeholder="Masukkan email anda">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Secure Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input id="password" type="password" name="password" required 
                        class="block w-full rounded-2xl border-gray-100 bg-gray-50 py-4 pl-12 pr-5 focus:ring-4 focus:ring-blue-50 focus:border-blue-500 focus:bg-white shadow-sm transition-all duration-200 outline-none font-bold text-gray-800"
                        placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center px-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-gray-200 text-blue-600 shadow-sm focus:ring-blue-500 transition-all" name="remember">
                    <span class="ms-3 text-xs text-gray-500 font-bold group-hover:text-gray-700 transition-colors">Ingat sesi saya</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="button" onclick="confirmLogin()" class="w-full py-5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-[11px]">
                    Masuk ke Sistem
                </button>
            </div>

            @if (Route::has('register'))
                <div class="mt-8 text-center border-t border-gray-50 pt-8">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                        Belum terdaftar? 
                        <a href="{{ route('register') }}" class="text-blue-600 font-black hover:text-blue-800 transition-all ml-1">Buat Akun Baru</a>
                    </p>
                </div>
            @endif
        </form>
    </div>

    <p class="text-center text-gray-300 text-[9px] mt-10 font-bold uppercase tracking-[0.4em]">
        &copy; 2026 SIPRAS Traffic Control
    </p>

    <script>
        const SiprasSwal = Swal.mixin({
            customClass: {
                popup: 'sipras-swal-popup',
                confirmButton: 'sipras-swal-confirm',
                cancelButton: 'sipras-swal-cancel'
            },
            buttonsStyling: false
        });

        // Konfirmasi sebelum masuk
        function confirmLogin() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if(!email || !password) {
                document.getElementById('loginForm').reportValidity();
                return;
            }

            SiprasSwal.fire({
                title: 'Konfirmasi Akses',
                text: 'Apakah Anda yakin ingin masuk ke dashboard SIPRAS sekarang?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Masuk',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#2563eb',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('loginForm').submit();
                }
            });
        }

        // Tampilkan eror jika kredensial salah
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                SiprasSwal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak',
                    text: 'Email atau password yang Anda masukkan tidak valid.',
                    confirmButtonText: 'Coba Lagi'
                });
            @endif
        });
    </script>
</x-guest-layout>