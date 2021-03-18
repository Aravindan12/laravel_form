<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    <title>forgot password</title>
</head>
<body>
    <form action = "{{ route('forgotpassword') }}" method = "POST">
    @csrf
    <div class="form-group">
    <label>Email</label>
    <input type = "email" placeholder = "Enter your email address" name = "email">
    </div>
    <button class="btn btn-success">Submit</button>         
    </form>
</body>
</html>