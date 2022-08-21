<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-list"></i> Products</a></a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('product') }}">
                <i class="nav-icon lab la-product-hunt"></i><span>Product List</span>
            </a>
        </li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('property') }}'><i class='nav-icon la la-question'></i> Properties</a></li>
    </ul>
</li>

