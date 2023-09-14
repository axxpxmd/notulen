<ul class="sidebar-menu">
    <li class="header"><strong>MAIN NAVIGATION</strong></li>
    <li>
        <a href="{{ route('home') }}">
            <i class="icon icon-dashboard2 blue-text s-18"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Permission : Role|Permission|Pengguna -->
    @canany(['Role', 'Permission', 'Pengguna'])
        <li class="header light"><strong>CONFIG ROLES</strong></li>
    @endcanany
    @can('Permission')
        <li class="no-b">
            <a href="{{ route('master-role.permission.index') }}">
                <i class="icon icon-clipboard-list text-success s-18"></i>
                <span>Permission</span>
            </a>
        </li>
    @endcan
    @can('Role')
        <li>
            <a href="{{ route('master-role.role.index') }}">
                <i class="icon icon-key3 amber-text s-18"></i>
                <span>Role</span>
            </a>
        </li>
    @endcan
    @can('Pengguna')
        <li class="no-b">
            <a href="{{ route('master-role.pengguna.index') }}">
                <i class="icon icon-user-o text-success s-18 mr-1"></i>
                <span>Pengguna</span>
            </a>
        </li>
    @endcan
    <li class="header light"><strong>CONFIG DATA</strong></li>
    <li class="no-b">
        <a href="{{ route('config.opd.index') }}">
            <i class="icon icon-clipboard-list text-danger s-18"></i>
            <span>OPD</span>
        </a>
    </li>
</ul>
