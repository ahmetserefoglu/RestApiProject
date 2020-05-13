@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{Auth::user()->rolename}} Arayüzü</h1>
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> {{Auth::user()->rolename}} Arayüzü</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('sweet::alert')
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Dikkat!</strong> Giriş Değerleriniz ile İlgili Bazı Problemleriniz Vardır. Kontrol ediniz.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{ __('Gelir') }}</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="{{ route('gelir.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="{{ route('gelir.store') }}" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="pl-lg-4">
                  <div class="form-group{{ $errors->has('gelir_adi') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Gelir Adi') }}</label>
                    <div class="input-group">
                      <select name="gelir_adi"class="form-control select2" style="width: 100%;">
                        <option >Seçiniz</option>
                        <option  value="Aidat">Aidat</option>
                        <option  value="Demirbas">DemirBaş</option>
                        <option  value="Kira">Kira</option>
                        <option  value="Ek">Ek</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('gelir_kisi') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Gelir Kisi') }}</label>
                    <div class="input-group">
                      <select name="gelir_kisi"class="form-control select2" style="width: 100%;">
                        <option ></option>
                          @foreach ($users as $user)
                          <option  value="{{ $user->name }}">{{$user->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('gelir_miktar') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Gelir Miktar') }}</label>
                    <input type="number" step="0.01" name="gelir_miktar" id="input-name" class="form-control form-control-alternative{{ $errors->has('gelir_miktar') ? ' is-invalid' : '' }}"  placeholder="{{ __('Gelir Miktar') }}" required autofocus>
                  </div>
                  <div class="form-group{{ $errors->has('gelir_tarih') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Gelir Tarih') }}</label>
                    <input type="date" step="0.01" name="gelir_tarih" id="input-name" class="form-control form-control-alternative{{ $errors->has('gelir_tarih') ? ' is-invalid' : '' }}" placeholder="{{ __('Gelir Tarih') }}" required autofocus>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-success mt-8">{{ __('Kaydet') }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>


        </section>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection
