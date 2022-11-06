<!-- This file is used to store topbar (right) items -->

<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-bell"></i><span class="badge badge-pill badge-danger">1</span></a></li>
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <img class="img-avatar" src="https://d3mdebq4ntr9r6.cloudfront.net/eyJidWNrZXQiOiJ6MS1wcm9kLXMzIiwia2V5IjoiejFfcHJvZHVjdGlvblwvdXBsb2Fkc1wvaW1hZ2VzXC8yMDIxMDFcLzEyYTViNWNkN2Y1MTgzMDY5YjRhZWYyNDhiZjI4ZTAwLnBuZyIsImVkaXRzIjp7InJlc2l6ZSI6eyJ3aWR0aCI6MTUwLCJoZWlnaHQiOjE1MCwiZml0IjoiaW5zaWRlIn19fQ==" alt="{{ backpack_auth()->user()->name }}">
    </a>
    <div class="dropdown-menu py-2 {{ config('backpack.base.html_direction') == 'rtl' ? 'dropdown-menu-left' : 'dropdown-menu-right' }} mr-4 pb-1 pt-1 triangle-menu-user">
      <a class="dropdown-item" href="{{ route('backpack.account.info') }}"><i class="la la-user"></i> {{ trans('backpack::base.my_account') }}</a>
      <a class="dropdown-item" href="{{ backpack_url('logout') }}"><i class="la la-lock"></i> {{ trans('backpack::base.logout') }}</a>
    </div>
  </li>
  <span class="custom-padding d-none d-md-block">
    <p class="mb-0 mr-4" style="font-size: 13px"><strong>{{ backpack_auth()->user()->name }}</strong></p>
</span>


