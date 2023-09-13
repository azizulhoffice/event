<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin/dashboard')}}" class="nav-link">Dashboard</a>
    </li> --}}

</ul>

<!-- SEARCH FORM -->
{{-- <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form> --}}

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">

    <!-- User Account: style can be found in dropdown.less -->
    <li class="nav-item dropdown" style="margin-top:4px;">
        <a href="#" class="user dropdown-toggle" data-toggle="dropdown" style="margin:10px;">
            <span class="hidden-xs">{{ Auth::user()->role }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg">
            <!-- Menu Footer-->
            <li class="user-footer">
                <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt">
                        Logout</i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
        </a>
    </li>
</ul>
