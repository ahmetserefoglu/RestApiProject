@extends('layouts.app')
@section('css')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

@stop
@section('content')
@section('css')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

<link href="{{ asset('css/preview.css') }}" rel="stylesheet">

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
      @include('layouts.flash-message')
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
           <div class="row">
            <div class="col-md-12">
            <div class="card bg-gradient-info">
              <div class="card-header">
                <h3 class="card-title">Değerlendirme</h3>
              </div>
              <div class="card-body">
                Hizmetlerimizi buradan değerlendirebilirsiniz
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
          <!-- Small boxes (Stat box)  -->
          <div class="row">
            @if($degerlendirmelersx->count())
              @foreach ($degerlendirmelersx as $degerlendirme)
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1">
                    <a href="#" class="small-box-footer"> <i class="far fa-star"></i></a>
                  </span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{$degerlendirme->degerlendirme_konu}}</span>
                    <span class="info-box-number">{{ $degerlendirme->total_derece }}
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              @endforeach
            @endif
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header no-border">
                  <h3 class="card-title">Değerlendirmeler</h3>
                  <div class="card-tools">
                    <a href="{{ route('degerlendirme.create') }}" class="btn btn-tool btn-sm">
                      <i class="fas fa-plus"></i>
                    </a>
                <!--<a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>-->
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>D.Konu</th>
                    <th>D.Kisi</th>
                    <th>Rate</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($degerlendirmeler as $degerlendirme)
                  <tr>
                    <td>
                      <i class="icon ion-md-arrow"></i>
                      {{ $degerlendirme->degerlendirme_konu  }}
                    </td>
                    <td>
                      {{ $degerlendirme->degerlendiren_kullanici  }}
                    </td>
                    <td>
                      <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $degerlendirme->degerlendirme_derece }}" data-size="xs" disabled="">
                    </td>
                    <td>
                       
                      <form class="row" method="POST" action="{{ route('degerlendirme.destroy', ['id' => $degerlendirme->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('degerlendirme.edit', ['id' => $degerlendirme->id]) }}" class="btn btn-block bg-gradient-primary btn-sm">
                          Güncelle
                        </a>
                        <button class="btn btn-block bg-gradient-danger btn-sm">Sil</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{ $degerlendirmeler->links() }}
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</section>
<!-- /.content -->
</div>

<!-- /.content-wrapper -->
@endsection
@section('js')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
   $("#input-id").rating();
</script>
<script type="text/javascript">
 
  $(document).ready(function() {


    @if(Session::get('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    console.log(type);
    switch(type){
      case 'info':
      toastr.info("{{ Session::get('message') }}",{
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      });
      break;

      case 'warning':
      toastr.warning("{{ Session::get('message') }}");
      break;

      case 'success':
      toastr.success("{{ Session::get('message') }}");
      break;

      case 'error':
      toastr.error("{{ Session::get('message') }}");
      break;
    }
    @endif


    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
    });

    @if ($message = Session::get('message'))
    Toast.fire({
      type: 'success',
      title: "{{Session::get('message')}}"
    })
    @endif

    @if ($message = Session::get('ss'))
    Toast.fire({
      type: 'error',
      title: 'Beklenmedik Bir Hata Oluştu'
    })
    @endif

  });
</script>
@stop