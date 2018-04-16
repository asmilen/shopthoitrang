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
