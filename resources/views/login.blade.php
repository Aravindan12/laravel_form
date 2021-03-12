<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form method = "POST" action="{{ route('auth') }}">
   {{csrf_field()}}

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
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label>Name</label>
    <input type="text" name="name" placeholder="Enter your name">
    </div>
   
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter your password">
    </div>

    <div class="form-group">
    <button class="btn btn-success">Submit</button>
    </div>
    <p>If you are new please<a href="/register"> register here</a></p>
    <form>
</body>
</html>