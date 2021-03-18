<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    <title>Document</title>
</head>
<body>
<form action = "{{ route('newpassword') }}" method = "POST">
    @csrf
    @if(count($errors))
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.
				<br/>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>   
			</div>
		@endif
        <?php $token = csrf_token();?>
        <div class="form-group">
            <input type="hidden" value="{{$getEmail->email}}" name="email">
            <div class="form-group">
    <div class="form-group">
    <label>Password</label>
    <input type = "password" placeholder = "Enter your new password" name = "password">
    </div>
    <div class="form-group">
    <label> Confirm Password</label>
    <input type = "password" placeholder = "Enter your new password" name = "password1">
    </div>
    <button class="btn btn-success">Submit</button>         
    </form>
</body>
</html>