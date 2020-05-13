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
                        <h3 class="mb-0">{{ __('Gelir Düzenle') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('gelir.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('gelir.update', ['id' => $gelir->id]) }}" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('gelir_adi') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Gelir Adi') }}</label>
                    <div class="input-group">
                      <select name="gelir_adi"class="form-control select2" style="width: 100%;">
                        <option >Seçiniz</option>
                        @if($gelir->gelir_adi == '1')
                        {
                          <option  value="1" selected="select">Aidat</option>
                          <option  value="2">DemirBaş</option>
                          <option  value="3">Kira</option>
                          <option  value="4">Ek</option>
                        }
                        @elseif($gelir->gelir_adi == '2')
                        {
                          <option  value="1">Aidat</option>
                          <option  value="2"  selected="select">DemirBaş</option>
                          <option  value="3">Kira</option>
                          <option  value="4">Ek</option>
                        }  
                        @elseif($gelir->gelir_adi == '3')
                        {
                          <option  value="1">Aidat</option>
                          <option  value="2" >DemirBaş</option>
                          <option  value="3"  selected="select">Kira</option>
                          <option  value="4">Ek</option>
                        }  
                        @else
                        {
                          <option  value="1">Aidat</option>
                          <option  value="2">DemirBaş</option>
                          <option  value="3">Kira</option>
                          <option  value="4"  selected="select">Ek</option>
                        }                         
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('gelir_kisi') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Gelir Kisi') }}</label>
                    <div class="input-group">
                      <select name="gelir_kisi"class="form-control select2" style="width: 100%;">
                        @foreach ($users as $user)
                        @if($gelir->gelir_kisi == $user->name)
                        {
                          <option  value="{{ $user->name }}" selected="user">{{$blok->name}}</option>
                        }                       
                        @else
                        <option  value="{{ $user->name }}">{{$user->name}}</option>
                        @endif
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('gelir_miktar') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Gelir Miktar') }}</label>
                    <input type="number" step="0.01" name="gelir_miktar" id="input-name" class="form-control form-control-alternative{{ $errors->has('gelir_miktar') ? ' is-invalid' : '' }}" value="{{ old('gelir_miktar', $gelir->gelir_miktar) }}" placeholder="{{ __('Gelir Miktar') }}" required autofocus>
                  </div>
                  <div class="form-group{{ $errors->has('gelir_tarih') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Gelir Tarih') }}</label>
                    <input type="date" step="0.01" name="gelir_tarih" id="input-name" class="form-control form-control-alternative{{ $errors->has('gelir_tarih') ? ' is-invalid' : '' }}"  value="{{ old('gelir_tarih', $gelir->gelir_tarih) }}"placeholder="{{ __('Gelir Tarih') }}" required autofocus>
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
