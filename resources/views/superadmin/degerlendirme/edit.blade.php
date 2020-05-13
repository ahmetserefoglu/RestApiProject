@extends('layouts.app')

@section('content')
@section('css')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

@stop
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
                        <h3 class="mb-0">{{ __('Değerlendirme Düzenle') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('degerlendirme.index') }}" class="btn btn-sm btn-primary">{{ __('Geri Dön') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('degerlendirme.update', ['id' => $degerlendirme->id]) }}" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('degerlendirme_konu') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('D.Konu') }}</label>
                    <div class="input-group">
                      <select name="degerlendirme_konu"class="form-control select2" style="width: 100%;">
                        <option >Seçiniz</option>
                        @if($degerlendirme->degerlendirme_konu == 'yonetim')
                        {
                          <option  value="yonetim" selected="select">Yönetim</option>
                          <option  value="temizlik" >Temizlik</option>
                          <option  value="siparis">Sipariş</option>
                          <option  value="gorevli">Görevli</option>
                          <option  value="asansor">Asansör</option>
                        }
                        @elseif($degerlendirme->degerlendirme_konu == 'temizlik')
                        {
                          <option  value="yonetim">Yönetim</option>
                          <option  value="temizlik" selected="select">Temizlik</option>
                          <option  value="siparis" >Sipariş</option>
                          <option  value="gorevli">Görevli</option>
                          <option  value="asansor">Asansör</option>
                        } 
                        @elseif($degerlendirme->degerlendirme_konu == 'siparis')
                        {
                          <option  value="yonetim">Yönetim</option>
                          <option  value="temizlik">Temizlik</option>
                          <option  value="siparis" selected="select">Sipariş</option>
                          <option  value="gorevli">Görevli</option>
                          <option  value="asansor">Asansör</option>
                        }  
                        @elseif($degerlendirme->degerlendirme_konu == 'gorevli')
                        {
                          <option  value="yonetim">Yönetim</option>
                          <option  value="temizlik">Temizlik</option>
                          <option  value="siparis">Sipariş</option>
                          <option  value="gorevli" selected="select">Görevli</option>
                          <option  value="asansor">Asansör</option>
                        } 
                        @else
                        {
                          <option  value="yonetim">Yönetim</option>
                          <option  value="temizlik">Temizlik</option>
                          <option  value="siparis">Sipariş</option>
                          <option  value="gorevli">Görevli</option>
                          <option  value="asansor" selected="select">Asansör</option>
                        }                         
                        @endif
                      </select>
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('degerlendirme_derece') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('D.derece') }}</label>,
                    <div class="rating">
                      <input id="input-1" name="degerlendirme_derece" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="$degerlendirme->degerlendirme_derece" data-size="xs">
                    </div>
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
@section('js')
<script type="text/javascript">
  $("#input-id").rating();
</script>
@stop