<div class="widget full-height">
    <div class="full-height d-flex flex-column p-l-15 gap-l-15 bg-white border border-monochrome-100 rounded-l-5">
        <div class="widget-header d-flex justify-between w-100">
            <h3 class="text">
                {{ $title }}
            </h3>
            {{ $toggler }}
        </div>
        @if(!empty($filter))
            <div class="widget-filter" data-widget="filter">
                {{ $filter }}
            </div>
        @endif
        <div class="widget-body flex-grow-1" data-widget="body">
            {{ $body }}
        </div>
    </div>
</div>
{{ $script }}
