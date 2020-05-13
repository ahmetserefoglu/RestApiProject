<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$ad}}</h2>
<br/>
Your registered email-id is {{$mail}} , Please click on the below link to verify your email account
<br/>
<a href="{{url('user/verify', $token)}}">Verify Email</a>



</body>

</html>