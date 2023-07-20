<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$data['subject']}}</title>
    <style>
        /* Reset default styles */
        body, p, h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }

        /* Set background color and font styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f6f6f6;
            color: #333;
        }

        /* Container style */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header style */
        .header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Content style */
        .content {
            background-color: #fff;
            padding: 20px;
        }

        /* Footer style */
        .footer {
            background-color: #f6f6f6;
            padding: 10px;
            text-align: center;
            color: #888;
        }

        /
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Service App</h1>
        </div>
        <div class="content">
            <h2>Hello {{$data['name']}},</h2>
            <p>{{$data['body']}}</p>
        </div>
        <div class="footer">
            <p>Thank you for using our service!</p>
        </div>
    </div>
</body>
</html>
