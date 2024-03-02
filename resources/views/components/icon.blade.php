@if(str($name)->startsWith('l-'))
    <i {{ $attributes->class('icon-wrapper')->merge(['class' => $color]) }}>{!! File::get(resource_path(). '/images/svg/' . $name . '.svg') !!}</i>
@else
    <i {{ $attributes->class('icon-wrapper') }} data-feather='{{ $name }}'></i>
@endif
