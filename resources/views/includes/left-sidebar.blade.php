<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
    <img src="{{asset('dist/img/avatar5.png')}}" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Event</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            {{--<img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">--}}
        </div>
        <div class="info">
            <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            {{-- @can('dashboard-view') --}}
            <li class="nav-item {{ isActive(['admin/dashboard*']) }}">
                <a href="#" class="nav-link {{ isActive('admin/dashboard*') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            {{-- @endcan
            @can('users') --}}
            <li class="nav-item {{ isActive(['admin/users*']) }}">
                <a href="{{ route('users.index') }}" class="nav-link {{ isActive('admin/users*') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
            {{-- @endcan --}}

            <!--participant start-->
            <li
                class="nav-item has-treeview {{ isActive(['admin/participants*']) }}">
                <a href="#"
                    class="nav-link {{ isActive(['admin/participants*']) }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Participant
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/participants/create') }}"
                            class="nav-link {{ isActive('admin/participants/create') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Participant</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/participants') }}" class="nav-link {{ isActive('admin/participants') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All participants</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--participant end-->


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
