<aside class="sidebar">
    <h2 class="sidebar-title">ADMIN</h2>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}">Data User</a>
        </li>
        <li>
            <a href="{{ route('admin.kategoris.index') }}">Data Kategori</a>
        </li>
        <li>
            <a href="{{ route('admin.alats.index') }}">Data Alat</a>
        </li>
        <!-- ===== LOG AKTIVITAS ===== -->
        <li>
            <a href="{{ route('admin.log-aktivitas.index') }}">Log Aktivitas</a>
        </li>
    </ul>
</aside>
