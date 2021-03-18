<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    <title>Form</title>
</head>
<body>
    <form method = "POST" action="{{ route('valid') }}">
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
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label>Name</label>
    <input type="text" name="name" placeholder="Enter your name">
    </div>
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email">
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter your password">
    </div>
    <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
    <label>Confirm_Password</label>
    <input type="password" name="confirm_password" placeholder="Confirm your password">
    </div>
    <div class="form-group">
    <button class="btn btn-success">Submit</button>
    </div>
    <p>If you are already registered please<a href="/login"> login here</a></p>
    <form>
</body>
</html>