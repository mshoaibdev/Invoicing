<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Payment Failed
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">


</head>
<body>

    <div class="container">
        <div class="jumbotron mt-4  text-center justify-center">
            <div
                class="alert alert-success"
                role="alert"
            >
                <strong>
                    Failed!    
                </strong> {{ request()->get('message') }}
            </div>

          </div>
    </div>
</body>
</html>
