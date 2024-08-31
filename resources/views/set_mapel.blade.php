@extends('dash')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12 mb-4">
                <h6>Pengaturan <span class="fas fa-arrow-right"></span> Mapel</h6>

                <div class="messages"></div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="filter-class">
                                    <div class="form-group mb-3">
                                        <label for="">
                                            Kelas
                                        </label>
                                        <select name="class_id" class="form-control" style="width: 30%">
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($class as $c)
                                                <option value="{{$c->id}}">{{$c->nama_rombel}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success filter">
                                        Filter
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div id="gur-maping-mapel" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageTitle', 'Menentukan Guru Mapel')
