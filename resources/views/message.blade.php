@extends('dash')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl-12 mb-4">
            <h6>Pesan</h6>

            <div class="row">
                <div class="col-md-12">
                    <div class="messages"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div id="message-data"></div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <form id="send-info">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="">Judul</label>
                                    <input type="text" name="judul" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Isi Pesan</label>
                                    <textarea name="isi_pesan" cols="30" rows="10" class="form-control text-editor"></textarea>
                                </div>

                                <button type="submit" class="btn btn-success simpan">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.pesan')
@endsection

@section('pageTitle', 'Data Pesan')
