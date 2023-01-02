<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="margin-top:150px;">
        <div style="text-align:center;" >
            <img style="" src="https://i.ibb.co/MVCCTpK/email.png" alt="statistic">
        </div>
        <div style="text-align:center;">
            <h2 style="" >{{__('authenticate.confirm_email')}}</h2>
            <h3 style="" >{{__('authenticate.email_verification_text')}}</h3>
            <a style="margin-top:40px; padding:15px; text-align:center;background-color:#0FBA68;
            border-radius:8px;color:white;text-decoration:none;" href="{{$url}}">{{__('authenticate.verify_email')}}</a>
        </div>
    </div>
</body>
</html>

