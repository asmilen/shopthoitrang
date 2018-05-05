@if (Sentinel::check())
<!-- #section:basics/sidebar -->
<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    @if ($currentUser->hasAnyAccess(['admin.users.index', 'admin.roles.index', 'admin.permissions.index']))
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            @if ($currentUser->hasAccess('admin.users.index'))
            <a class="btn btn-success" href="{{ url('/quantri/users') }}">
                <i class="ace-icon fa fa-user"></i>
            </a>
            @endif

            @if ($currentUser->hasAccess('admin.roles.index'))
            <a class="btn btn-info" href="{{ url('/quantri/roles') }}">
                <i class="ace-icon fa fa-users"></i>
            </a>
            @endif

            @if ($currentUser->hasAccess('admin.permissions.index'))
            <a class="btn btn-warning" href="{{ url('/quantri/permissions') }}">
                <i class="ace-icon fa fa-lock"></i>
            </a>
            @endif
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->
    @endif

    <ul class="nav nav-list">
        <li class="{{ (Request::is('quantri') || Request::is('quantri/*')) ? 'active' : '' }}">
            <a href="{{ url('/quantri') }}"><i class="menu-icon fa fa-tachometer"></i> <span class="menu-text"> Dashboard </span></a>
        </li>


    @if ($currentUser->hasAccess('admin.categories.index') || $currentUser->hasAccess('admin.attributes.index'))
        <li class="{{ (Request::is('quantri/categories') || Request::is('quantri/categories/*') || Request::is('quantri/attributes') || Request::is('quantri/attributes/*') || Request::is('quantri/manufacturers') || Request::is('quantri/manufacturers/*')) ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Quản lý danh mục </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu nav-show" style="display: none;">
                @if ($currentUser->hasAccess('admin.categories.index'))
                    <li class="{{ (Request::is('quantri/categories') || Request::is('quantri/categories/*')) ? 'active' : '' }}">
                        <a href="{{ url('/quantri/categories') }}"><i class="menu-icon fa fa-folder"></i> <span class="menu-text"> Danh mục </span></a>
                    </li>
                @endif

                @if ($currentUser->hasAccess('admin.attributes.index'))
                    <li class="{{ (Request::is('quantri/attributes') || Request::is('quantri/attributes/*')) ? 'active' : '' }}">
                        <a href="{{ url('/quantri/attributes') }}"><i class="menu-icon fa fa-list-alt"></i> <span class="menu-text"> Thuộc tính </span></a>
                    </li>
                @endif

                @if ($currentUser->hasAccess('admin.manufacturers.index'))
                    <li class="{{ (Request::is('quantri/manufacturers') || Request::is('quantri/manufacturers/*')) ? 'active' : '' }}">
                        <a href="{{ url('quantri/manufacturers') }}"><i class="menu-icon fa fa-cube"></i> <span class="menu-text"> Nhà SX </span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    </ul><!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>
<!-- /section:basics/sidebar -->
@endif
