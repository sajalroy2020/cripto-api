<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['title']}}</title>
    <style>
        .mail-box{
            text-align: center;
            padding: 40px 0px;
        }
    </style>
</head>
<body>
    <div class="mail-box">
        <p>{{$data['body']}}</p>
        <a href="{{$data['url']}}"> Click here verify your mail.</a>
        <h4>Thak You</h4>
    </div>
</body>
</html>
