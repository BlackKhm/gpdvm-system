@php
    /**
     * How to use
     *
     * @param array $entry [menu, url, title]
     * @param string $roles
     * @param string $permission
     * @param boolean $rolePermissionDefaul: true using string, false using model method
     *
     * @include('partials.admins.sidebars.link', [
     *   'entry' => [backpack_url('role'), trans('flexi.roles')],
     *   'roles' => 'Developer|Admin',
     *   'permission' => 'user list',
     * ], 'nolink' => true)
     *
     */
    $isRoleOrPermissionOrNone = true;
    if (isset($roles) && $roles) {
        if (isset($rolePermissionDefaul) && $rolePermissionDefaul) {
            $isRoleOrPermissionOrNone = backpack_user()->hasAnyRole($roles);
        } else {
            $isRoleOrPermissionOrNone = backpack_user()->{$roles}();
        }

    }

    if (!isset($roles) && isset($permission) && $permission) {
        if (isset($rolePermissionDefaul) && $rolePermissionDefaul) {
            $isRoleOrPermissionOrNone = backpack_user()->can($permission);
        } else {
            $isRoleOrPermissionOrNone = backpack_user()->{$permission}();
        }
    }
@endphp

@if($isRoleOrPermissionOrNone)
    <a
        class="btn btn-sm {{ $entry[0] ? 'btn-info' : 'btn-secondary' }}"
        href="{!! isset($nolink) ? '#': $entry[1] !!}"
    >
        {!! isset($entry[2]) && $entry[2] ? $entry[2] : 'tab' !!}
    </a>
@endif
