<div class="row">
    <div class="col-md-4 mb-4">
        <div class="alert alert-info">
            <span>Tahun Ajaran : {{$tahun}}</span>
            <br>
            <span>Kelas : {{$nama_kelas}}</span>
        </div>
        <div class="list-group">
            @foreach ($ekskul as $e)
                <button type="button" data-id="{{$e->id}}" data-tahun="{{$tahun}}" data-class="{{$class}}" class="list-group-item list-group-item-action nilai">{{$e->nama_ekstrakulikuler}}</button>
            @endforeach
        </div>
    </div>
    <div class="col-md-8 mb-4">
        <div id="nilai-ekskul"></div>
    </div>
</div>
