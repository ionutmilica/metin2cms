<section class="sidebar">
    <ul class="sidebar-menu">
        <a href="{{ route('admin.home') }}" class="btn btn-primary btn-lg" style="margin: 10px 0 10px 50px; color: #ffffff;" target="_blank">View Site</a>
        <li {{ Route::is('admin.home') ? 'class="active"' : '' }}>
            <a href="{{ route('admin.home') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li {{ Route::is('admin.account.index') ? 'class="active"' : '' }}>
            <a href="{{ route('admin.account.index') }}">
                <i class="fa fa-dashboard"></i> <span>Accounts</span>
            </a>
        </li>
        <!-- Players -->
         <li class="treeview {{ Route::is('admin.player.index') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-table"></i> <span>Players</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li {{ Route::is('admin.player.index') ? 'class="active"' : '' }}>
                    <a href="{{ route('admin.player.index')  }}">
                        <i class="fa fa-angle-double-right"></i> Players list
                    </a>
                </li>
            </ul>
        </li>
         <li class="treeview {{ Route::is('admin.staff.index') || Route::is('admin.staff.create') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-table"></i> <span>Ingame staff</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li {{ Route::is('admin.staff.index') ? 'class="active"' : '' }}>
                    <a href="{{ route('admin.staff.index')  }}">
                        <i class="fa fa-angle-double-right"></i> Staff list
                    </a>
                </li>
                <li {{ Route::is('admin.staff.create') ? 'class="active"' : '' }}>
                    <a href="{{ route('admin.staff.create')  }}">
                        <i class="fa fa-angle-double-right"></i> Add to staff
                    </a>
                </li>
            </ul>
        </li>

         <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('admin.settings.general') }}">
                        <i class="fa fa-angle-double-right"></i> General
                    </a>
                </li>
                <li>
                    <a href="{{ '' }}">
                        <i class="fa fa-angle-double-right"></i> Email
                    </a>
                </li>
                <li>
                    <a href="{{ '' }}">
                        <i class="fa fa-angle-double-right"></i> Modules
                    </a>
                </li>

            </ul>
        </li>
        {{--
            Here at the end of the navbar we should fire
            and event that adds link for every modules.
        --}}
    </ul>
</section>