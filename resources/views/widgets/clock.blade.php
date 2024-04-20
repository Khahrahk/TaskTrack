<x-widget>
    <x-slot:title>
{{--        {{ $config['name'] }}--}}
    </x-slot:title>
    <x-slot:toggler>
{{--        @include('widgets.size-toggler', $config)--}}
    </x-slot:toggler>
    <x-slot:body>
        <div class="d-flex flex-column align-items-start gap-l-15 h-100">
            <div class="d-flex flex-column justify-content-start align-items-start w-100 flex-grow-1">
                <div class="slider">
                    <div class="swiper-container swiper-no-swiping">
                        <div class="swiper-wrapper ">
                            <div class="swiper-slide d-flex flex-column justify-content-around align-items-start w-100">
                                <div class="placeholder-glow d-flex flex-column py-l-10 align-items-start w-100 pt-2">
                                    <div class="d-flex w-100 justify-content-center align-items-start">
                                        <span class="placeholder rounded-pill bg-monochrome-200" style="width: 50%; height: 50px"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:body>
    <x-slot:script>
{{--        <script>--}}
{{--            widgetsClasses.Clock = class Clock extends AbstractWidget {--}}
{{--                constructor() {--}}
{{--                    super();--}}
{{--                    this.lazy = true;--}}
{{--                    this.syncInterval = 1;--}}
{{--                }--}}

{{--                afterUpdateAsyncData() {--}}
{{--                    super.afterUpdateAsyncData();--}}
{{--                    this.body.innerHTML = this.data;--}}
{{--                }--}}
{{--            }--}}
{{--        </script>--}}
    </x-slot:script>
</x-widget>
