<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700" rel="stylesheet">

   


</head>
@php
    $logo = get_setting('header_logo');
@endphp
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly;">
    
    

    <!-- CSS Reset : BEGIN -->
    <style>
@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
  u~div .email-container {
    min-width: 320px !important;
  }
}
@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
  u~div .email-container {
    min-width: 375px !important;
  }
}
@media only screen and (min-device-width: 414px) {
  u~div .email-container {
    min-width: 414px !important;
  }
}
</style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>
@media screen and (max-width: 500px) {}
</style>
<p>{{ $array['subject'] }}</p>
<p style="font-family:'Ubuntu', Arial,sans-serif; font-size:20px; line-height:26px; text-align:center; color:#2e57ae; padding-bottom:30px;">{{ $array['content'] }}</p>

@if(!empty( $array['link']))
<p>Hello Customer,</p>
<p>To complete your registration as a Cusorcart Customer,please click the button below to verify your email address:</p>
<br>
<center><a href="{{ $array['link'] }}" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-decoration: none; background: #007bff; padding: 0.9rem 2rem; font-size: 0.875rem; color: #fff; border-radius: .2rem;" target="_blank">{{ translate("Verify Email") }}</a></center>
<br>
<br>
<p>Cusorcart takes your account security very seriously. Cusorcart will never email you and ask you to
disclose or verify your Cusorcart password, credit card or banking account number . If you receive suspicious email with a link  to update your account information, do not click on the link – instead, report the email to Cusorcart for investigation.</p>
<p><strong>Thanks for visting Cusorcart!</strong></p>
<p><strong>{{ route('home') }}</strong></p>
@endif


   
</body>

</html>