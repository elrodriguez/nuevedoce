<div class="card mb-g">
    <div class="row row-grid no-gutters">
        <div class="col-12">
            <div class="p-3">
                <h2 class="mb-0 fs-xl">
                    Usuarios con sesiones hoy
                </h2>
            </div>
        </div>
        @foreach($sessions as $session)
        <div class="col-4">
            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                @if(file_exists(public_path('storage/person/'.$session->person_id.'/'.$session->person_id.'.png')))
                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('{{ asset('storage/person/'.$session->person_id.'/'.$session->person_id.'.png') }}'); background-size: cover;"></span>
                @else
                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('{{ ui_avatars_url(auth()->user()->name,32,'none') }}'); background-size: cover;"></span>
                @endif
                <span class="d-block text-truncate text-muted fs-xs mt-1">{{ $session->name }}</span>
            </a>
        </div>
        @endforeach
    </div>
</div>
