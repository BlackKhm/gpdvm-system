<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i
            class="la la-home nav-icon"></i>{{ trans('backpack::base.dashboard') }}</a></li>
{{-- <li class="nav-title">First-Party Addons</li> --}}
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-list"></i> User Management</a></a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact') }}'>
            <i class="nav-icon lab la-product-hunt"></i>Contacts</a>
        </li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('account') }}'>
            <i class="nav-icon lab la-product-hunt"></i>Accounts</a>
        </li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-list"></i> CRM</a></a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('property') }}'>
            <i class="nav-icon lab la-product-hunt"></i>Properties</a>
        </li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}">
            <i class="nav-icon la la-user"></i><span>Users</span></a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}">
            <i class="nav-icon la la-id-badge"></i> <span>Roles</span></a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}">
            <i class="nav-icon la la-key"></i> <span>Permissions</span></a>
        </li>
    </ul>
</li>
