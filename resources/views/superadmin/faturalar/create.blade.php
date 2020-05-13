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
                        <h3 class="mb-0">{{ __('Yeni Fatura') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('faturalar.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('faturalar.store') }}" autocomplete="off">
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('fatura_adi') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Fatura Adı') }}</label>
                            <input type="text" name="fatura_adi" id="input-name" class="form-control form-control-alternative{{ $errors->has('fatura_adi') ? ' is-invalid' : '' }}" value="{{ old('fatura_adi', ($fatura_adi ==' ') ? ' ': $fatura_adi) }}" placeholder="{{ __('Fatura Adı') }}"  required autofocus>
                        </div>
                        <div class="form-group{{ $errors->has('fatura_numarasi') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Fatura Numarasi') }}</label>
                            <input type="text" name="fatura_numarasi" id="input-name" class="form-control form-control-alternative{{ $errors->has('fatura_numarasi') ? ' is-invalid' : '' }}" placeholder="{{ __('Fatura Numarasi') }}" required autofocus>
                        </div>
                        @if($fatura_adi != 'İnternet' && $fatura_adi != 'Temizlik' && $fatura_adi != 'Asansör')
                        <div class="form-group{{ $errors->has('fatura_ilkendeks') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Fatura İlk Endeks') }}</label>
                            <input type="number" name="fatura_ilkendeks" id="input-name" class="form-control form-control-alternative{{ $errors->has('fatura_ilkendeks') ? ' is-invalid' : '' }}" placeholder="{{ __('Fatura İlk Endeks') }}" required autofocus>
                        </div>
                        <div class="form-group{{ $errors->has('fatura_sonendeks') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Fatura Son Endeks') }}</label>
                            <input type="number" name="fatura_sonendeks" id="input-name" class="form-control form-control-alternative{{ $errors->has('fatura_sonendeks') ? ' is-invalid' : '' }}" placeholder="{{ __('Fatura Son Endeks') }}" required autofocus>
                        </div>
                        @endif
                        <div class="form-group{{ $errors->has('fatura_tutar') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Fatura Tutarı') }}</label>
                            <input type="number" name="fatura_tutar" id="input-name" class="form-control form-control-alternative{{ $errors->has('fatura_tutar') ? ' is-invalid' : '' }}" placeholder="{{ __('Fatura Tutarı') }}" required autofocus>
                        </div>
                        <div class="form-group{{ $errors->has('fatura_tarih') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Fatura Tarih') }}</label>
                            <input type="date" name="fatura_tarih" id="input-name" class="form-control form-control-alternative{{ $errors->has('fatura_tarih') ? ' is-invalid' : '' }}" placeholder="{{ __('Fatura Tarih') }}" required autofocus>
                        </div>
                         <div class="form-group{{ $errors->has('fatura_durum') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-password">{{ __('Fatura Durum') }}</label>
                            <div class="input-group">
                              <select name="fatura_durum"class="form-control select2" style="width: 100%;">
                                <option value="0">Seçiniz</option>
                                <option  value="1">Ödendi</option>
                                <option  value="2">Ödenmedi</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('fatura_detay') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-email">{{ __('Fatura Detay') }}</label>
                            <textarea class="textarea" id="fatura_detay" name="fatura_detay" placeholder="Fatura Detayı"
                            style="width: 100%; height: 130px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
