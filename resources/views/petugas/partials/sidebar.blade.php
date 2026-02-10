<aside class="sidebar">
    <h2 class="sidebar-title">PETUGAS</h2>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('petugas.dashboard') }}"
               class="{{ request()->is('petugas/dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('petugas.peminjaman.index') }}"
               class="{{ request()->is('petugas/peminjaman*') ? 'active' : '' }}">
                Peminjaman
            </a>
        </li>

        <li>
            <a href="{{ route('petugas.pengembalian.index') }}"
               class="{{ request()->is('petugas/pengembalian*') ? 'active' : '' }}">
                Pengembalian
            </a>
        </li>

        {{-- MENU LAPORAN --}}
        <li>
            <a href="{{ route('petugas.laporan.pengembalian') }}"
               class="{{ request()->is('petugas/laporan*') ? 'active' : '' }}">
                Laporan
            </a>
        </li>
    </ul>
</aside>
