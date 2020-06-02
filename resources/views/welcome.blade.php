<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="author" content="Grayrids">
  <title>{{trans('adminlte.titleonline')}}</title>
  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/animate.css')}}">
  <link rel="stylesheet" href="{{ asset('css/LineIcons.css')}}">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.css')}}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.css')}}">
  <link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{ asset('css/nivo-lightbox.css')}}">
  <link rel="stylesheet" href="{{ asset('css/main.css')}}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">
  <style type="text/css">


    .modal-title {
      margin-bottom: 0 !important;
      /* line-height: 1.5; */
    }

  }
  .modal-footer {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding: 1rem !important;
    border-top: 1px solid #e9ecef;
  }

  .modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-clip: padding-box;
    border: 14px solid rgba(0,0,0,.2) !important;
    border-radius: 2.3rem !important;
    outline: 0;
  }
  #exampleModal{
    padding-right: 1px !important;
  }

  .btn {
    color:  #6610f2 !important;
    font-size: 10px;
  }

  .underline.show {
    text-decoration: underline;
    color: #0062cc !important;
  }

  .menu-bg .navbar-nav .active {
    color: black !important;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
<body>

  <header id="home" class="hero-area">
    <div class="overlay">
      <span></span>
      <span></span>
    </div>
    <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
      <div class="container">
        <a href="index.html" class="navbar-brand"><!--<img src="{{ asset('images/logo.png') }}" alt="">--></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <i class="lni-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto w-100 justify-content-end">
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#home">{{trans('adminlte.home')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#services">{{trans('adminlte.howwork')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#contact">{{trans('adminlte.contact')}}</a>
            </li>
            @php $locale = session()->get('locale'); @endphp
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Dil <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="lang/tr"><img src="{{asset('images/tr.png')}}" width="30px" height="20x"> Turkey</a>
                <a class="dropdown-item" href="lang/en"><img src="{{asset('images/eng.png')}}" width="30px" height="20x"> English</a>
              </div>
            </li>
            <li class="nav-item" style="color:black;margin-left: 10px;">
              <button type="button" class="btn btn-primary" data-toggle="modal"  data-target="#exampleModal" data-whatever="@mdo">{{ trans('adminlte.session') }}</button>
              <div class="modal fade" id="exampleModal" style="padding-right: 150px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" style="margin-left: 125px;">Panel Giriş</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active underline" style="color:black;margin-left:115px;" id="home-tab" data-toggle="tab" href="#girisyap" role="tab" aria-controls="home" aria-selected="true" >{{ trans('adminlte.session') }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link underline" id="profile-tab" style="margin-left: 50px;color:black;"  data-toggle="tab" href="#kayitol" role="tab" aria-controls="profile" aria-selected="false">{{ trans('adminlte.register_message') }}</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="girisyap" role="tabpanel" aria-labelledby="home-tab">
                          <div class="card">
                            <div class="card-body login-card-body">
                              <form action="{{ route('login') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                  <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                                  placeholder="{{ trans('adminlte.email') }} yada {{ trans('adminlte.phone_number') }}">
                                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                  @if ($errors->has('email'))
                                  <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                                  @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                  <input type="password" name="password" class="form-control"
                                  placeholder="{{ trans('adminlte.password') }}">
                                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                  @if ($errors->has('password'))
                                  <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                                  @endif
                                </div>
                                <div class="row">
                                  <div class="col-8">
                                    <a href="/password/reset">{{ trans('adminlte.forgotpassword') }}</a>
                                  </div>
                                  <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte.login') }}</button>
                                  </div>
                                </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="kayitol" role="tabpanel" aria-labelledby="profile-tab">
                          <div class="card">
                            <div class="card-body register-card-body">
                              <form method="POST" action="{{ route('register') }}">
                               @csrf
                               <div class="row">
                                <div class="col-12">
                                  <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="{{ trans('adminlte.fullname') }}">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                                  <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                    placeholder="{{ trans('adminlte.email') }}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                                  <div class="form-group has-feedback {{ $errors->has('phonenumber') ? 'has-error' : '' }}">
                                   <input type="tel" pattern="^\d{4}\d{3}\d{4}$" name="phonenumber" class="form-control"
                                   placeholder="Telefon Numarası">
                                   <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                   @if ($errors->has('phonenumber'))
                                   <span class="help-block">
                                    <strong>{{ $errors->first('phonenumber') }}</strong>
                                  </span>
                                  @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                  <input type="password" name="password" class="form-control"
                                  placeholder="{{ trans('adminlte.password') }}">
                                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                  @if ($errors->has('password'))
                                  <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                                  @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ trans('adminlte.retype_password') }}">
                                 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                 @if ($errors->has('password_confirmation'))
                                 <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                              </div>

                            </div>
                          </div>

                          <button type="submit"
                          class="btn btn-primary btn-block btn-flat"
                          >{{ trans('adminlte.register') }}</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <div class="row space-80">
    <div class="col-lg-4 col-md-12 col-xs-12 p-0">
      <div class="intro-img">
        <img src="{{ asset('images/business-img.png') }}" alt="">
      </div>
    </div>
    <div class="col-lg-8 col-md-12 col-xs-12">
      <div class="contents">
        <h2 class="head-title">{{trans('adminlte.headtitle')}}</h2>
        <p>{{trans('adminlte.titleexplanation')}} </p>
      </div>
    </div>

  </div>
</div>
</header>
@include('sweet::alert')
@if (session('status'))



<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif
@if (session('warning'))
<div class="alert alert-warning">
  {{ session('warning') }}
</div>
@endif
<section id="services" class="section">
  <div class="row">
    <div class="col-md-10">
      <div class="business-item-info" style="padding-left: 250px !important;">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  ...............
                </button>
              </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                ..................
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  .........
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
               ..................
             </div>
           </div>
         </div>
         <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                ............
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              ..............
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingFour">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                .........
              </button>
            </h5>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
            <div class="card-body">
             .........
           </div>
         </div>
       </div>
       <div class="card">
        <div class="card-header" id="headingFive">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
             .............
           </button>
         </h5>
       </div>
       <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
        <div class="card-body">
          ................
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingSix">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
           ..............
         </button>
       </h5>
     </div>
     <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
      <div class="card-body">
        ..........
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</section>
<section id="contact" class="section">
  <!-- Container Starts -->
  <div class="container">
    <!-- Start Row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="contact-text section-header text-center">
          <div>
            <h2 class="section-title">{{trans('adminlte.getintouch')}}</h2>
            <div class="desc-text">
              <p>{{trans('adminlte.getintouchexp')}}</p>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">

        <form  action="/contact" method="post" role="form" class="contactForm">
         {{ csrf_field() }}
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" name="name" id="InputName" placeholder="{{trans('adminlte.name')}}" required data-error="{{trans('adminlte.pleasename')}}">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" placeholder="{{trans('adminlte.subject')}}" name="subject" id="InputSubject" class="form-control"  required data-error="{{trans('adminlte.pleasesubject')}}">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="InputEmail" placeholder="{{trans('adminlte.email')}}" required data-error="{{trans('adminlte.pleasemail')}}">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <textarea class="form-control" name="message" id="message-text" placeholder="{{trans('adminlte.message')}}" rows="4" data-error="{{trans('adminlte.pleasemessage')}}" required></textarea>
              <div class="help-block with-errors"></div>
            </div>
            <div class="submit-button">
              <button class="btn btn-common" id="submit" type="submit" >{{trans('adminlte.submit')}}</button>
              <div id="msgSubmit" class="h3 hidden"></div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-1">
    </div>
    <div class="col-lg-4 col-md-12">
      <div class="contact-img">
        <img src="{{ asset('images/01.png') }}" class="img-fluid" alt="">
      </div>
    </div>
    <div class="col-lg-1">
    </div>
  </div>
</div>
</section>
<footer>
  <section id="footer-Content">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">

          <div class="footer-logo">
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
          <div class="widget">
            <h3 class="block-title">{{trans('adminlte.company')}}</h3>
            <ul class="menu">
              <li><a href="#">- {{trans('adminlte.aboutus')}}</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
          <div class="widget">
            <h3 class="block-title">{{trans('adminlte.product')}}</h3>
            <ul class="menu">
              <li><a href="#">- {{trans('adminlte.price')}}</a></li>
              <li><a href="#">- {{trans('adminlte.security')}}</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
          <div class="widget">
            <h3 class="block-title">{{trans('adminlte.downloadapp')}}</h3>
            <ul class="menu">
              <li><a href="#">- {{trans('adminlte.androidapp')}}</a></li>
              <li><a href="#">- {{trans('adminlte.iosapp')}}</a></li>
              <li><a href="#">- {{trans('adminlte.playstore')}}</a></li>
              <li><a href="#">- {{trans('adminlte.iosstore')}}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="copyright">
      <div class="container">
        <!-- Star Row -->
        <div class="row">
          <div class="col-md-12">
            <div class="site-info text-center">
              <strong>Copyright &copy; 2019 <a href=".....">SiteYonetimPaneli</a>.</strong>
              2019 / SiteYonetimPaneli
              <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0-beta.1
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

</footer>


<a href="#" class="back-to-top">
  <i class="lni-chevron-up"></i>
</a>

<div id="preloader">
  <div class="loader" id="loader-1"></div>
</div>
<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/inputmask/jquery.inputmask.js')}}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.extensions.js')}}"></script>

<script src="{{ asset('AdminLTE-3.0.0/plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="{{asset('js/jquery-min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.js')}}"></script>
<script src="{{asset('js/jquery.nav.js')}}"></script>
<script src="{{asset('js/scrolling-nav.js')}}"></script>
<script src="{{asset('js/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/nivo-lightbox.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
</body>
</html>