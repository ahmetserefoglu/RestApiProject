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
      @include('layouts.flash-message')
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
      <div class="container-fluid mt--7">
        <div class="row">
          <div class="col-xl-12 order-xl-1">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">{{ __('Yeni Kullanıcı') }}</h3>
                  </div>
                  <div class="col-4 text-right">
                    <a href="{{ route('kullanicilar.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form method="post" action="{{ route('kullanicilar.store') }}" autocomplete="off">
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="pl-lg-4">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <label class="form-control-label" for="input-name">{{ __('Ad Soyad') }}</label>
                      <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Ad Soyad') }}" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                      <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <label class="form-control-label" for="input-password">{{ __('Telefon Numarası') }}</label>
                      <input type="tel" pattern="^\d{4}\d{3}\d{4}$" name="phonenumber" class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" placeholder="XXXXXXXXXXX" value="" required>
                    </div>
                    <div class="form-group{{ $errors->has('site_id') ? ' has-danger' : '' }}">
                      <label class="form-control-label" for="input-rolename">{{ __('Site') }}</label>
                      <div class="input-group">
                        <select name="site_id" id="site_id" class="form-control select2" style="width: 100%;">
                          <option ></option>
                          @foreach ($sites as $site)
                          <option  value="{{ $site->id }}">{{$site->site_adi}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('blok_id') ? ' has-danger' : '' }}">
                      <label class="form-control-label" for="input-rolename">{{ __('Blok') }}</label>
                      <div class="input-group">
                        <select name="blok_id" id="blok_id" class="form-control select2" style="width: 100%;">
                          
                        </select>
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('rolename') ? ' has-danger' : '' }}">
                      <label class="form-control-label" for="input-rolename">{{ __('Yetki') }}</label>
                      <div class="input-group">
                        <select name="rolename" class="form-control select2" style="width: 100%;">
                          <option ></option>
                          @foreach ($roles as $rol)
                          <option  value="{{ $rol->name }}">{{$rol->name}}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('evsahibimi') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-password">{{ __('Ev Sahibi') }}</label>
                            <div class="input-group">
                              <select name="evsahibimi"class="form-control select2" style="width: 100%;">
                                <option value="0">Seçiniz</option>
                                <option  value="1">Evet</option>
                                <option  value="2">Hayır</option>
                              </select>
                            </div>
                        </div>
                    <div class="form-group">
                      <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                      <input type="password" name="password" id="input-password" class="form-control form-control-alternative" placeholder="{{ __('Password') }}" value="" required>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                      <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="" required>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-success mt-4">{{ __('Kaydet') }}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@endsection

