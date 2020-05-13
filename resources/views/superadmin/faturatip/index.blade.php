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
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('Fatura Tipleri') }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('kullanicilar.create') }}" class="btn btn-sm btn-primary">{{ __('Kullanıcı Ekle') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Adi Soyadi</th>
                    <th>Mail</th>
                    <th>Telefon Numarası</th>
                    <th>Yetki</th>
                    <th>Onay</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($users as $uye)
              <tr role="row" >
                  <td>{{ $uye->name }}</td>
                  <td>{{ $uye->email }}</td>
                  <td>{{ $uye->phonenumber }}</td>
                  <td>{{ $uye->rolename }}</td>
                  <td>{{ $uye->verified }}</td>
                  <td>
                     <form class="row" method="POST" action="{{ route('kullanicilar.destroy', ['id' => $uye->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ route('kullanicilar.edit', ['id' => $uye->id]) }}" class="btn btn-block bg-gradient-primary btn-sm">
                        Güncelle
                    </a>
                    <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                        Sil
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->


</section>
</div>
</div><!-- /.container-fluid -->
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