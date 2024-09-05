@extends('siswa.dash')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl-12 mb-4">
            <h6>Lihat Nilai</h6>
        </div>

        <div class="row">
            <div class="col-md-4">
                <form id="filter-show-nilai">
                    <div class="form-group mb-3">
                        <select name="tahun_ajaran" class="form-control">
                            <option value=""> -- Pilih -- </option>
                            @foreach ($tahun as $t)
                                <option>{{$t->tahun_ajaran}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success mt-3 filter">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div id="show-nilai"></div>
    </div>
</div>

@endsection
@section('pageTitle', 'Lihat Nilai')
