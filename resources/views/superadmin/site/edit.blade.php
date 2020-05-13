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
        <section class="col-lg-6 connectedSortable">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{ __('Site Yönetim Düzenle') }}</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="{{ route('siteyonetim.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="{{ route('site.update', ['id' => $site->id]) }}" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PATCH">
                <div class="pl-lg-4">
                  <div class="form-group{{ $errors->has('site_adi') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Site Adı') }}</label>
                    <input type="text" name="site_adi" id="input-name" class="form-control form-control-alternative{{ $errors->has('site_adi') ? ' is-invalid' : '' }}" placeholder="{{ __('Site Adı') }}" value="{{ old('site_adi', $site->site_adi) }}"  required autofocus>
                  </div>
                  <div class="form-group{{ $errors->has('site_yonetici_adi') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Yönetici Adi') }}</label>
                    <input type="text" name="site_yonetici_adi" id="input-name" class="form-control form-control-alternative{{ $errors->has('site_yonetici_adi') ? ' is-invalid' : '' }}" value="{{ old('site_yonetici_adi', $site->site_yonetici_adi) }}" placeholder="{{ __('Site Yönetici Adi') }}" required autofocus>
                  </div>
                  <div class="form-group{{ $errors->has('aidat') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('Aidat') }}</label>
                    <input type="number" step="0.01" name="aidat" id="input-name" class="form-control form-control-alternative{{ $errors->has('aidat') ? ' is-invalid' : '' }}" placeholder="{{ __('Aidat') }}" value="{{ old('aidat', $site->aidat) }}"  required autofocus>
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
