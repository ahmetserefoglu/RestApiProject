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
                        <h3 class="mb-0">{{ __('Yeni Araç Plaka') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('aracplaka.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('aracplaka.store') }}" autocomplete="off">
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('arac_sahibi') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Araç Sahibi') }}</label>
                            <input type="text" name="arac_sahibi" id="input-name" class="form-control form-control-alternative{{ $errors->has('arac_sahibi') ? ' is-invalid' : '' }}"  placeholder="{{ __('Araç Sahibi') }}"  required autofocus>
                        </div>
                        <div class="form-group{{ $errors->has('arac_plaka') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-email">{{ __('Araç Plaka') }}</label>
                            <textarea class="textarea" id="arac_plaka" name="arac_plaka" placeholder="Ariza Detayı"
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
     <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ __('Yeni Araç Plaka') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('aracplaka.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                  <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"  action="{{ route('aracplaka.importarac')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="file" name="file" />
        <button class="btn btn-primary">{{ trans('adminlte.İmportFile') }}</button>
      </form>
          </div>
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
