@extends('layouts.dd')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="container">
  <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
</div>
<!-- /.content-wrapper -->
@endsection
