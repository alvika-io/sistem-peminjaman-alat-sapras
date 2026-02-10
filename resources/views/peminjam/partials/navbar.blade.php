<nav class="navbar">
    <div class="navbar-left">
        <span class="brand">Sistem Peminjaman Alat - Peminjam</span>
    </div>

    <div class="navbar-right">
        <span class="user-info">
            {{ auth()->user()->name }}
            <small>({{ auth()->user()->role }})</small>
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                Logout
            </button>
        </form>
    </div>
</nav>
