<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Name Field --}}
            <div class="group">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 flex items-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Nama Lengkap
                </label>
                <div class="relative">
                    <input id="name" name="name" type="text" class="peer w-full rounded-2xl border-2 border-slate-50 bg-slate-50/50 py-4 px-6 font-bold text-slate-800 transition-all focus:border-{{ $primaryColor }}-500 focus:bg-white focus:ring-4 focus:ring-{{ $primaryColor }}-500/10 outline-none placeholder:text-slate-300" value="{{ old('name', $user->name) }}" required autofocus placeholder="Contoh: John Doe">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Email Field --}}
            <div class="group">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 flex items-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Alamat Email
                </label>
                <div class="relative">
                    <input id="email" name="email" type="email" class="peer w-full rounded-2xl border-2 border-slate-50 bg-slate-50/50 py-4 px-6 font-bold text-slate-800 transition-all focus:border-{{ $primaryColor }}-500 focus:bg-white focus:ring-4 focus:ring-{{ $primaryColor }}-500/10 outline-none placeholder:text-slate-300" value="{{ old('email', $user->email) }}" required placeholder="nama@email.com">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="flex items-center gap-3 px-10 py-4 bg-{{ $primaryColor }}-600 hover:bg-{{ $primaryColor }}-700 text-white font-black rounded-[1.5rem] uppercase tracking-widest text-[11px] transition-all shadow-xl shadow-{{ $primaryColor }}-600/20 transform hover:-translate-y-1 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>