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
                  <h3 class="mb-0">{{ __('Siparis Düzenle') }}</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="{{ route('siparis.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="{{ route('siparis.update', ['id' => $siparis->id]) }}" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PATCH">
                <div class="pl-lg-4">
                  <div class="form-group{{ $errors->has('siparis_konu') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('S.Konu') }}</label>
                    <input type="text" name="siparis_konu" id="input-name" class="form-control form-control-alternative{{ $errors->has('siparis_konu') ? ' is-invalid' : '' }}"  value="{{ old('siparis_konu', $siparis->siparis_konu) }}" placeholder="{{ __('S. Konu') }}" required autofocus>
                  </div>
                  <div class="form-group{{ $errors->has('siparis_detay') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-email">{{ __('S. Detay') }}</label>
                    <textarea class="textarea" id="siparis_detay" name="siparis_detay" placeholder="S. Detayı"
                    style="width: 100%; height: 130px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                    {{$siparis->siparis_detay}}
                  </textarea>
                </div>
                <div class="form-group{{ $errors->has('siparis_isteyen_kisi') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-name">{{ __('S.İ.Kisi') }}</label>
                  <div class="input-group">
                    <select name="siparis_isteyen_kisi"class="form-control select2" style="width: 100%;">
                      @foreach ($users as $user)
                      @if($siparis->siparis_isteyen_kisi == $user->name)
                      {
                        <option  value="{{ $user->name }}" selected="user">{{$siparis->siparis_isteyen_kisi}}</option>
                      }                       
                      @else
                      <option  value="{{ $user->name }}">{{$user->name}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group{{ $errors->has('siparis_tarihi') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-name">{{ __('S. Tarih') }}</label>
                  <input type="date" name="siparis_tarihi" id="input-name" class="form-control form-control-alternative{{ $errors->has('siparis_tarihi') ? ' is-invalid' : '' }}"  value="{{ old('siparis_tarihi', $siparis->siparis_tarihi) }}"placeholder="{{ __('S. Tarih') }}" required autofocus>
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
