@include('partials.sharable.overlay.style', [
    'style' => [
        'max-width' => '400px'
    ]
])
<style>
    #customer-filter-form input {
        /* height: auto; */
    }

    #customer-filter-form .select2-container {
        /* width: 100%; */
    }

    #customer-filter-form li.nav-item {
    /* .navbar-filters li { */
        width: 100%;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    #customer-filter-form li:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    #customer-filter-form li .dropdown-menu {
        position: static;
        display: block;
        margin-top: 0;
    }

    /* #customer-filter-form li .dropdown-menu.show { */
    #customer-filter-form li .dropdown-menu.hide-menu {
        position: absolute;
        display: none;
        margin-top: 0;
    }

    #customer-filter-form .navbar-collapse.collapse {
    /* .navbar-filters .navbar-collapse.collapse { */
        display: block;
        width: 100%;
    }

    #customer-filter-form .nav.navbar-nav {
        width: 100%;
    }

    #customer-filter-form .nav-link.dropdown-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    #customer-filter-form .input-group.date {
        width: 100%;
    }

    #customer-filter-form a:hover {
        text-decoration: none;
    }

    .navbar-filters .collapse .dropdown-toggle{
        /* background-color: #fafafa; */
        color: #1b2a4e;
        background-color: #d9e2ef;
        border-color: #d9e2ef;
        padding: 5px 10px !important;
    }

    #customer-filter-form li .dropdown-menu .overflow-auto{
        max-height: 268px;
    }
</style>
