<div>
    <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="app-list w-auto h-auto p-0 text-left">
                        @if(count($shortcuts) > 0)
                            @foreach($shortcuts as $shortcut)
                                <li>
                                    <a href="{{ route($shortcut->route_name) }}" class="app-list-item text-white border-0 m-0">
                                        <div class="icon-stack">
                                            <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                            <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                            <i class="{{ $shortcut->icon }} icon-stack-1x opacity-100 color-white"></i>
                                        </div>
                                        <span class="app-list-name">
                                            {{ $shortcut->name }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                        <li>
                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                <div class="icon-stack">
                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                    <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                </div>
                                <span class="app-list-name">
                                    Add More
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
