@extends('guru.home')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12 mb-4">
          <h6>Input Kenaikan Siswa</h6>

          <div class="row">
            <div class="col-md-4">
                <form id="filter-kenaikan">
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
        </div>
       <div id="show-kenaikan-siswa"></div>
    </div>
</div>
@endsection
@section('pageTitle', 'Kenaikan')
