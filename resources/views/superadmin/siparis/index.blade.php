@extends('layouts.app')
@section('css')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

@stop
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
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="row">
            <div class="col-md-12">
            <div class="card bg-gradient-warning">
              <div class="card-header">
                <h3 class="card-title">Sipariş ...</h3>
              </div>
              <div class="card-body">
                Siparişlerinizi buradan ilgili sorumluya iletebilirsiniz.
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header no-border">
                  <h3 class="card-title">Siparis</h3>
                  <div class="card-tools">
                    <a href="{{ route('siparis.create') }}" class="btn btn-tool btn-sm">
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
                    <th>S.Konu</th>
                    <th>S.Detay</th>
                    <th>S.Kisi</th>
                    <th>S.Tarih</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($siparisler as $siparis)
                  <tr>
                    <td>
                      <i class="icon ion-md-arrow"></i>
                      {{ $siparis->siparis_konu  }}
                    </td>
                    <td>
                      {{ $siparis->siparis_detay  }}
                    </td>
                    <td>
                      {{ $siparis->siparis_isteyen_kisi  }}
                    </td>
                    <td>
                      {{ $siparis->siparis_tarih  }}
                    </td>
                    <td>
                      <form class="row" method="POST" action="{{ route('siparis.destroy', ['id' => $siparis->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('siparis.edit', ['id' => $siparis->id]) }}" class="btn btn-block bg-gradient-primary btn-sm">
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
                {{ $siparisler->links() }}
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