<div id="mySidenav" class="sidenav shadow  {{ $position ?? 'right' }}">
    <a class="nav-link button-close-overlay position-absolute" style="cursor: pointer;">
        <i class="las la-times text-danger"></i>
    </a>
    @if (count($views) > 0)
        @foreach ($views as $view)
            {!! $view !!}
        @endforeach
    @endif
    <button id="back_to_top" class="btn btn-danger button-close-overlay d-none">
        <i class="las la-times text-white"></i>
    </button>
</div>
