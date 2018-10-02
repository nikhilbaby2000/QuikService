@extends('email.layout')

@section('content')
    @include('email.template.partials._content-title')
    <div style="margin:0 auto;max-width:600px;background:#fff">
        <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0;width:100%;background:#fff" align="center" border="0">
            <tbody>
            <tr>
                <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0;padding:20px 0">
                    <div class="mj-column-px-600 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%">
                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                            <tbody>
                            <tr>
                                <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                                    <div style="cursor:auto;color:#555;font-family:Roboto,Arial,sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:left">
                                        <p style="margin-bottom: 20px;">Dear <b>{{$address_to}}</b>,</p>
                                        <p>Greetings from QuikService Relocation Services.</p>
                                        <p>This email address is being used to avail the corporate benefits on QuikService.com. If you had initiated the process, please enter the verification code that appears below in the verification Box on QuikService.com!</p>
                                        <p></p>
                                        <span>Verification Code: <h2>{{$otp}}</h2></span>

                                        <p>If you did not initiate the process, please ignore this communication. Do not forward or give this code to anyone.</p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection