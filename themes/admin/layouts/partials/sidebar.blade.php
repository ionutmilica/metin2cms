<section class="sidebar">
    <a href="{{ route('home') }}" class="btn btn-primary btn-lg" style="margin: 10px 0 10px 50px; color: #ffffff;" target="_blank">View Site</a>
    <ul class="sidebar-menu">
        <li {{ Route::currentRouteName() == 'admin.home' ? 'class="active"' : '' }}>
            <a href="{{ route('admin.home') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li {{ Route::currentRouteName() == 'admin.account.index' ? 'class="active"' : '' }}>
            <a href="{{ route('admin.account.index') }}">
                <i class="fa fa-dashboard"></i> <span>Accounts</span>
            </a>
        </li>
         <li class="treeview" {{ Route::currentRouteName() == 'admin.staff.index' ? 'class="active"' : '' }}>
            <a href="#">
                <i class="fa fa-table"></i> <span>Ingame staff</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('admin.staff.index')  }}">
                        <i class="fa fa-angle-double-right"></i> Staff list
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.staff.create')  }}">
                        <i class="fa fa-angle-double-right"></i> Add to staff
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</section>