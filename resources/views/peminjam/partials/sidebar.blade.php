<div class="sidebar">
    <div class="sidebar-title">
        Peminjam
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('peminjam.dashboard') }}"
               class="{{ request()->routeIs('peminjam.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('peminjam.peminjaman.index') }}"
               class="{{ request()->routeIs('peminjam.peminjaman.*') ? 'active' : '' }}">
                Peminjaman
            </a>
        </li>
    </ul>
</div>
