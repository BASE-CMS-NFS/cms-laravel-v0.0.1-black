<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'helvetica';
                font-style: normal;
                font-weight: 400;
               
            }
        }
        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }
        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        table {
            border-collapse: collapse !important;
        }
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }
        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        @if($image != '')
        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#f4f4f4" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111;
                         font-family: 'helvetica'; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <img src="{{url('storage/'.$image)}}" width="100%" height="100%" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        @endif

        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 10px 10px 5px 30px; color: #000000;
                        font-family: 'helvetica'; font-size: 18px; font-weight: 400; line-height 25px;">
                            <p style="margin: 0;">Halo {{$email}}</p>
                        </td>
                    </tr>

                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 5px 10px 5px 30px; color: #666666; 
                        font-family: 'helvetica'; font-size: 14px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">
                                @php
                                    echo $content;
                                @endphp
                            </p>
                           
                        </td>
                    </tr>

                    @if($data)
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 5px 10px 5px 30px; color: #666666; 
                        font-family: 'helvetica'; font-size: 14px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">
                                @php
                                    echo $data;
                                @endphp
                            </p>
                           
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 5px 10px 5px 30px; color: #666666; 
                        font-family: 'helvetica'; font-size: 14px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">
                                @php
                                    echo $description;
                                @endphp
                            </p>
                           
                        </td>
                    </tr>

                    @if($link != '')
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 5px 10px 5px 30px; color: #666666; 
                        font-family: 'helvetica'; font-size: 14px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">
                                {{$link}}
                            </p>
                           
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; 
                        border-radius: 0px 0px 4px 4px; color: #666666;
                         font-family: 'helvetica'; font-size: 14px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Terimakasih,<br>Salam dari <br>{{$from_name}} !</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#f4f4f4" align="center" style="padding: 30px 0px 30px 30px; 
                        border-radius: 4px 4px 4px 4px; color: #565658; font-family: 'helvetica'; font-size: 14px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; text-align:center;color: #463a3a; margin: 0;">Customer Support</h2>
                            <br>
                            <a href="mailto:{{$from_email}}">{{$from_email}}</a>
                            &nbsp;&nbsp;
						    <p style="margin-bottom: 10px; text-align: center;">Copyright {{date('Y')}}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>      
    </table>
</body>

</html>