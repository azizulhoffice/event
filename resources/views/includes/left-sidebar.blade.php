<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
    <img src="{{asset('dist/img/avatar5.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
        @php
        $user = auth()->user();
        $role = $user->role;
        @endphp
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @if($role == "admin")
            <li class="nav-item {{ isActive(['admin/dashboard*']) }}">
                <a href="{{ url('/') }}" class="nav-link {{ isActive('admin/dashboard*') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <!--users start-->
            <li class="nav-item has-treeview {{ isActive(['admin/users*']) }}">
                <a href="#" class="nav-link {{ isActive(['admin/users*']) }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Users
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/users/create') }}" class="nav-link {{ isActive('admin/users/create') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/users') }}" class="nav-link {{ isActive('admin/users') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Users</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--users end-->
            @endif
            @if($role == "admin" || $role == "event-manager")
            <!--participant start-->
            <li class="nav-item has-treeview {{ isActive(['admin/participants*']) }}">
                <a href="#" class="nav-link {{ isActive(['admin/participants*']) }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Participant
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if ($role == "admin")
                    <li class="nav-item">
                        <a href="{{ url('admin/participants/create') }}" class="nav-link {{ isActive('admin/participants/create') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Import Participant</p>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ url('admin/participants') }}" class="nav-link {{ isActive('admin/participants') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All participants</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--participant end-->

            <!--Event start-->
            <li class="nav-item has-treeview {{ isActive(['admin/events*']) }}">
                <a href="#" class="nav-link {{ isActive(['admin/events*']) }}">
                    <i class="nav-icon far fa-calendar"></i>
                    <p>
                        Event
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if ($role == "admin")
                    <li class="nav-item">
                        <a href="{{ url('admin/events/create') }}" class="nav-link {{ isActive('admin/events/create') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Event</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ url('admin/events') }}" class="nav-link {{ isActive('admin/events') }}" title="Result UnPublished Event">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Unpublished Event</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('events.published') }}" class="nav-link {{ isActive('admin/events/published') }}" title="Result Published Event">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Published Event</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--Event end-->
            <!--Bulk Score start-->
            <li class="nav-item">
                <a href="{{ route('events.bulk-score') }}" class="nav-link {{ isActive('/bulk-score-update') }}">
                    <i class="nav-icon fas fa-bullseye"></i>
                    <p>Event Bulk Score</p>
                </a>
            </li>
            <!--Bulk Score end-->



            <!--Group start-->
            <li class="nav-item has-treeview {{ isActive(['admin/groups*']) }}">
                <a href="#" class="nav-link {{ isActive(['admin/groups*']) }}">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                        Group
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if ($role == "admin")
                    <li class="nav-item">
                        <a href="{{ url('admin/groups/create') }}" class="nav-link {{ isActive('admin/groups/create') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Group Manage</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <!--Group end-->

            <!--Category start-->
            <li class="nav-item has-treeview {{ isActive(['admin/categories*']) }}">
                <a href="#" class="nav-link {{ isActive(['admin/categories*']) }}">
                    <i class="nav-icon fa fa-list"></i>
                    <p>
                        Category
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if ($role == "admin")
                    <li class="nav-item">
                        <a href="{{ url('admin/categories/create') }}" class="nav-link {{ isActive('admin/categories/create') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Category Manage</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <!--Category end-->
            @endif

            @if($role == 'judge')
            <!--Judge start-->
            <li class="nav-item">
                <a href="{{ url('judge/') }}" class="nav-link {{ isActive('judge/') }}">
                    <i class="nav-icon far fa-calendar"></i>
                    <p> Events @if($role == "event-manager") Markings @endif</p>
                </a>
            </li>
            @endif
            <!--Judge end-->
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
