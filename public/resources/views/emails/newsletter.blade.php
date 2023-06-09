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



 <center style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; width: 100%; background-color: #f1f1f1; margin-top: 30px;">
        <div style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; display: none; font-size: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; max-width: 600px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin: 0 auto;">
                <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                    <td valign="top" class="bg_white" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #ffffff; padding: 1em 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin: 0 auto;">
                            <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                                <td class="logo" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-align: center; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" align="center">
                                    <h1 style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-family: 'Playfair Display', sans-serif; color: #000000; margin-top: 0; font-weight: 400; margin: 0;background-color:#102847"><a target="_blank" href="{{ route('home') }}/" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-decoration: none; color: #000000; font-size: 30px; font-weight: 700; font-family: 'Playfair Display', sans-serif;"><img style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-interpolation-mode: bicubic; height: 80px; width: 300px;" src="{{ uploaded_asset($logo) }}" width="300" height="80" border="0" alt=""></a></h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
                <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                    <td valign="top" class="bg_white" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #ffffff; padding: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin: 0 auto;">
                            <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                                <td width="60%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-align: center; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" align="center">
                                    <ul class="navigation" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 0; padding: 1em 0; border-top: 1px solid rgba(0, 0, 0, .05); border-bottom: 1px solid rgba(0, 0, 0, .05); margin-bottom: 0;">
                                        <li style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; list-style: none; display: inline-block; margin-left: 5px; margin-right: 5px; font-size: 13px; font-weight: 500; text-transform: uppercase;"><a target="_blank" href="{{ route('home') }}" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-decoration: none; color: rgba(0, 0, 0, 1);">Home</a></li>
                                        <li style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; list-style: none; display: inline-block; margin-left: 5px; margin-right: 5px; font-size: 13px; font-weight: 500; text-transform: uppercase;"><a target="_blank" href="{{ route('home') }}/categories" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-decoration: none; color: rgba(0, 0, 0, 1);">Catrgories</a></li>
                                        <li style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; list-style: none; display: inline-block; margin-left: 5px; margin-right: 5px; font-size: 13px; font-weight: 500; text-transform: uppercase;"><a target="_blank" href="{{ route('home') }}/flash-deals" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-decoration: none; color: rgba(0, 0, 0, 1);">Flash Deals</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
                
                <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                    <td valign="middle" class="intro bg_white" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #ffffff; position: relative; z-index: 0; padding: 2em 0 4em 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                        <table style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin: 0 auto;">
                            <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                                <td style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                    <div class="text" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color:black; padding: 0 2.5em; text-align: center;">
                                         <h2>{{ translate('NewsLetter') }}</h2>
                                        <p>@php echo $array['content']; @endphp</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
               
             
                <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                    <td valign="middle" class="bg_white" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #ffffff; padding: 2em 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                        <table style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin: 0 auto;">
                            <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                                <td style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                    <div class="text" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 0 2.5em; text-align: center;">
                                        <p style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"><a target="_blank" href="{{ route('home') }}/" class="btn btn-black-outline" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-decoration: none; padding: 5px 20px; display: inline-block; border-radius: 0px; background: transparent; border: 2px solid #ee9d1e; color: #102849; font-weight: 700;">Start Browsing</a></p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
                <!-- 1 Column Text + Button : END -->
            </table>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin: 0 auto;">
                <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                    <td valign="middle" class="bg_white footer" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #ffffff; border-top: 1px solid rgba(0, 0, 0, .05); color: rgba(0, 0, 0, .5); mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                        <table style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin: 0 auto;">
                            <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-align: left;" align="left">
                                <td valign="middle" width="60%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; text-align: left; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" align="left">
                                    <h3 class="heading" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-family: 'Playfair Display', sans-serif; margin-top: 0; font-weight: 400; color: #000; font-size: 15px;">Stay Updated On Newest Products</h3>
                                </td>
                                <td valign="middle" width="40%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; text-align: right; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" align="right">
                                    <ul class="social" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: 0; padding: 0;">
                                        <li style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; display: inline-block; margin-right: 10px; list-style: none; margin-bottom: 10px;"><img src="http://assets.stickpng.com/images/580b57fcd9996e24bc43c53e.png" alt="" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-interpolation-mode: bicubic; width: 40px; max-width: 600px; height: auto; display: block;" width="40"></li>
                                        <li style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; display: inline-block; margin-right: 10px; list-style: none; margin-bottom: 10px;"><img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-interpolation-mode: bicubic; margin-bottom: 9px; border-radius: 3px; width: 24px; max-width: 600px; height: auto; display: block;" width="24"></li>
                                        <li style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; display: inline-block; margin-right: 10px; list-style: none; margin-bottom: 10px;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/2048px-Instagram_icon.png" alt="" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-interpolation-mode: bicubic; padding-left: 6px; margin-bottom: 8px; width: 26px; max-width: 600px; height: auto; display: block;" width="26"></li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end: tr -->
               
            </table>

        </div>
    </center>
   
   
   
</body>

</html>