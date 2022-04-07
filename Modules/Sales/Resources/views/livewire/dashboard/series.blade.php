<div class="row">
    @if(count($series) > 0)
        @foreach ($series as $serie)
        <div class="col-sm-6 col-xl-3">
            <div style="background: {{ $serie['color'] }}" class="p-3 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $serie['id'].'-'.$serie['correlative'] }}
                        <small class="m-0 l-h-n">{{ $serie['description'] }}</small>
                    </h3>
                </div>
                <i class="fal fa-file-invoice-dollar position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
            </div>
        </div>
        @endforeach
    @endif
</div>
