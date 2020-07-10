<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview {{ request()->is('admin/users*') ? ' menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/users*') ? ' active' : '' }}">
                <i class="fas fa-users"></i>
                <p>
                    Users
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.create') }}" class="nav-link {{ request()->is('admin/users/create') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New User</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.messages.index') }}"
               class="nav-link {{ request()->is('admin/messages*') || request()->is('admin/*messages') ? ' active' : '' }}">
                <i class="far fa-envelope"></i>
                <p>Messages</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="document.getElementById('logoutform').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
