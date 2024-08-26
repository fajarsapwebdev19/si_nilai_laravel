@foreach ($data as $m)
<div class="card mt-2">
    <div class="card-header text-white bg-dark">
        {{$m->judul}}
        <br><br>
        <em class="fas fa-calendar"></em> {{date('d-m-Y H:i:s', strtotime($m->create_at))}} <em
            class="fas fa-user"></em> {{$m->user->personalData->nama}}
    </div>
    <div class="card-body">
        <p class="mt-3">
            {{$m->isi}}
        </p>
    </div>
</div>
@endforeach
