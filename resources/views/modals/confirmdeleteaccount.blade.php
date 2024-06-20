<div class="modal-body">
    <p class="text-center">
        Apakah Anda Yakin Ingin Menghapus Data ? {{$user->personalData->nama}}
        <br><br>
        @csrf
        <input type="hidden" id="id" value="{{$user->id}}">
        <button type="button" class="btn btn-success yes">
            Ya
        </button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
    </p>
</div>
