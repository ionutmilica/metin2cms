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
                        <li {{ Route::currentRouteName() == 'admin.staff.index' ? 'class="active"' : '' }}>
                            <a href="{{ route('admin.staff.index') }}">
                                <i class="fa fa-dashboard"></i> <span>Ingame Staff</span>
                            </a>
                        </li>
                    </ul>
                </section>