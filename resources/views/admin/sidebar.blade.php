<ul class="sidebar-top-level-items">
    <li class="{{ Request::is('*users') ? 'active' : '' }}"><a href="/admin/users" class="nav-link">Users</a></li>
    <li class="{{ Request::is('*roles') ? 'active' : '' }}"><a href="/admin/roles" class="nav-link">Roles</a></li>
    <li class="{{ Request::is('*permissions') ? 'active' : '' }}"><a href="/admin/permissions" class="nav-link">Permissions</a></li>
    <li class="{{ Request::is('*license') ? 'active' : '' }}"><a href="/admin/license" class="nav-link">License</a></li>
    <li class="{{ Request::is('*labels') ? 'active' : '' }}"><a href="/admin/labels" class="nav-link">Labels</a></li>
</ul>
