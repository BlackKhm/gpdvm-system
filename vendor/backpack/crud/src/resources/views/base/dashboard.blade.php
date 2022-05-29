@extends(backpack_view('blank'))


@php

    $widgets['before_content'][] = [
        'type'          => 'progress_white',
        'class'         => 'card mb-2',
        'value'         => '11.456',
        'description'   => 'Registered users.',
        'progress'      => 57, // integer
        'progressClass' => ' bg-primary',
        'hint'          => '8544 more until next milestone.',
    ];
    
    
@endphp


</div>
@section('content')

@endsection