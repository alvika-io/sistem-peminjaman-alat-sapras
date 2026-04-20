<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div class="space-y-8">
            {{-- Current Password dengan Fitur Toggle View --}}
            <div class="group max-w-md">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 flex items-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Password Saat Ini
                </label>
                
                <div class="relative">
                    <input id="current_password" name="current_password" type="password" 
                        class="w-full rounded-2xl border-2 border-slate-50 bg-slate-50/50 py-4 px-6 font-bold text-slate-800 transition-all focus:border-{{ $primaryColor }}-500 focus:bg-white focus:ring-4 focus:ring-{{ $primaryColor }}-500/10 outline-none placeholder:text-slate-200" 
                        autocomplete="current-password" placeholder="••••••••••••">
                    
                    {{-- Tombol Mata --}}
                    <button type="button" onclick="togglePassword('current_password', 'eye-icon-current')" class="absolute inset-y-0 right-0 pr-6 flex items-center text-slate-400 hover:text-{{ $primaryColor }}-500 transition-colors">
                        <svg id="eye-icon-current" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {{-- Icon Mata Terbuka (Default) --}}
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            {{-- Icon Mata Tertutup (Hidden by default) --}}
                            <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.055 10.055 0 012.113-3.344M8.878 8.878A3 3 0 1112.122 12.122m7.722 2.942A9.159 9.159 0 0112 5c-4.478 0-8.268 2.943-9.542 7a10.025 10.025 0 012.113 3.344m11.134 0a10.05 10.05 0 01-1.313 1.63M3 3l18 18" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="h-px bg-slate-100/50 w-full"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- New Password --}}
                <div class="group">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        Password Baru
                    </label>
                    <div class="relative">
                        <input id="new_password" name="password" type="password" class="w-full rounded-2xl border-2 border-slate-50 bg-slate-50/50 py-4 px-6 font-bold text-slate-800 transition-all focus:border-{{ $primaryColor }}-500 focus:bg-white focus:ring-4 focus:ring-{{ $primaryColor }}-500/10 outline-none placeholder:text-slate-200" autocomplete="new-password" placeholder="Min. 8 Karakter">
                        <button type="button" onclick="togglePassword('new_password', 'eye-icon-new')" class="absolute inset-y-0 right-0 pr-6 flex items-center text-slate-400 hover:text-{{ $primaryColor }}-500 transition-colors">
                            <svg id="eye-icon-new" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.055 10.055 0 012.113-3.344M8.878 8.878A3 3 0 1112.122 12.122m7.722 2.942A9.159 9.159 0 0112 5c-4.478 0-8.268 2.943-9.542 7a10.025 10.025 0 012.113 3.344m11.134 0a10.05 10.05 0 01-1.313 1.63M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                {{-- Confirm Password --}}
                <div class="group">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Ulangi Password Baru
                    </label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full rounded-2xl border-2 border-slate-50 bg-slate-50/50 py-4 px-6 font-bold text-slate-800 transition-all focus:border-{{ $primaryColor }}-500 focus:bg-white focus:ring-4 focus:ring-{{ $primaryColor }}-500/10 outline-none placeholder:text-slate-200" autocomplete="new-password" placeholder="Ulangi password">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
            <button type="submit" class="flex items-center gap-3 px-10 py-4 bg-{{ $primaryColor }}-600 hover:bg-{{ $primaryColor }}-700 text-white font-black rounded-[1.5rem] uppercase tracking-widest text-[11px] transition-all shadow-xl shadow-{{ $primaryColor }}-600/20 transform hover:-translate-y-1 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Perbarui Password
            </button>
        </div>
    </form>

    {{-- Script JS Simpel untuk Toggle --}}
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const openPaths = icon.querySelectorAll('.eye-open');
            const closedPaths = icon.querySelectorAll('.eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                openPaths.forEach(p => p.classList.add('hidden'));
                closedPaths.forEach(p => p.classList.remove('hidden'));
            } else {
                passwordInput.type = 'password';
                openPaths.forEach(p => p.classList.remove('hidden'));
                closedPaths.forEach(p => p.classList.add('hidden'));
            }
        }
    </script>
</section>