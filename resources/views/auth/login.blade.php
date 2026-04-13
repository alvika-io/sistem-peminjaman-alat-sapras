<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-guest-layout>
    <style>
        /* Hilangkan elemen bawaan yang mengganggu */
        .min-h-screen > div:first-child svg, nav { display: none !important; }
        
        body { 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc;
        }

        .min-h-screen { 
            background: radial-gradient(circle at top right, #eff6ff 0%, #f8fafc 100%) !important;
            display: flex !important; 
            flex-direction: column !important;
            align-items: center !important; 
            justify-content: center !important; 
            padding: 20px;
        }

        /* Overriding x-guest-layout container */
        .w-full.sm:max-w-md {
            box-shadow: none !important;
            background: transparent !important;
            border: none !important;
        }

        /* Modern Input Focus */
        .input-group:focus-within .input-icon { color: #2563eb; }
        .input-group:focus-within input { border-color: #2563eb; background: white; }

        /* SweetAlert Premium Radius */
        .sipras-swal-popup { border-radius: 2.5rem !important; padding: 2.5rem !important; font-family: 'Instrument Sans', sans-serif; }
        .sipras-swal-confirm { border-radius: 1.25rem !important; padding: 14px 40px !important; font-weight: 800 !important; text-transform: uppercase; font-size: 11px !important; letter-spacing: 0.1em !important; margin: 5px !important; background-color: #2563eb !important; color: white !important; }
        .sipras-swal-cancel { border-radius: 1.25rem !important; padding: 14px 40px !important; font-weight: 800 !important; text-transform: uppercase; font-size: 11px !important; letter-spacing: 0.1em !important; background-color: #f1f5f9 !important; color: #64748b !important; margin: 5px !important; }
        
        /* Smooth Entry Animation */
        .fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="fade-in-up w-full max-w-[440px] mx-auto">
        <div class="bg-white p-10 md:p-12 rounded-[3rem] shadow-[0_32px_64px_-12px_rgba(59,130,246,0.15)] border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-blue-50 rounded-full opacity-50"></div>

            <div class="mb-10 text-center relative z-10">
                <div class="inline-flex items-center justify-center bg-blue-600 w-20 h-20 rounded-[2rem] shadow-2xl shadow-blue-200 mb-6 mx-auto transition-all hover:scale-105 hover:rotate-3 duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-gray-900 tracking-tighter">SIPRAS</h2>
                <div class="flex items-center justify-center gap-2 mt-3">
                    <span class="h-[3px] w-4 bg-blue-600 rounded-full"></span>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.3em]">Dashboard Authentication</p>
                    <span class="h-[3px] w-4 bg-blue-600 rounded-full"></span>
                </div>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6 relative z-10">
                @csrf

                <div class="space-y-2 input-group">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Email Identity</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 input-icon transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                            class="block w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 py-4.5 pl-14 pr-6 focus:ring-0 focus:border-blue-600 focus:bg-white transition-all duration-300 outline-none font-bold text-gray-800 text-[15px]"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div class="space-y-2 input-group">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Secret Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 input-icon transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        <input id="password" type="password" name="password" required 
                            class="block w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 py-4.5 pl-14 pr-6 focus:ring-0 focus:border-blue-600 focus:bg-white transition-all duration-300 outline-none font-bold text-gray-800 text-[15px]"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center px-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <div class="relative">
                            <input id="remember_me" type="checkbox" class="peer hidden" name="remember">
                            <div class="w-5 h-5 border-2 border-gray-200 rounded-md peer-checked:bg-blue-600 peer-checked:border-blue-600 transition-all flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <span class="ms-3 text-[11px] text-gray-400 font-bold uppercase tracking-wider group-hover:text-gray-600 transition-colors">Ingat Sesi Saya</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="button" onclick="confirmLogin()" class="w-full py-5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-[0.98] uppercase tracking-[0.2em] text-[11px]">
                        Masuk ke Sistem
                    </button>
                </div>

                @if (Route::has('register'))
                    <div class="mt-8 text-center border-t border-gray-50 pt-8">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                            Belum terdaftar? 
                            <a href="{{ route('register') }}" class="text-blue-600 font-black hover:underline transition-all ml-1 text-nowrap">Buat Akun Member</a>
                        </p>
                    </div>
                @endif
            </form>
        </div>

        <p class="text-center text-gray-300 text-[9px] mt-10 font-bold uppercase tracking-[0.4em]">
            &copy; 2026 SIPRAS Traffic Control — V.2.0
        </p>
    </div>

    <script>
        const SiprasSwal = Swal.mixin({
            customClass: {
                popup: 'sipras-swal-popup',
                confirmButton: 'sipras-swal-confirm',
                cancelButton: 'sipras-swal-cancel'
            },
            buttonsStyling: false
        });

        function confirmLogin() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if(!email || !password) {
                document.getElementById('loginForm').reportValidity();
                return;
            }

            SiprasSwal.fire({
                title: 'Konfirmasi Akses',
                text: 'Pastikan kredensial yang Anda masukkan sudah benar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Masuk',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('loginForm').submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                SiprasSwal.fire({
                    icon: 'error',
                    title: 'Akses Gagal',
                    text: 'Email atau kata sandi salah. Silakan periksa kembali.',
                    confirmButtonText: 'Coba Lagi'
                });
            @endif
        });
    </script>
</x-guest-layout>