<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Halaman Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<link rel="stylesheet" href="css/auth_style.css">
	</head>

	<body>
		<div class="wrapper" style="background-image: url('images/bg.jpg');">
			<div class="inner">
				<div class="image-holder">
					<img src="images/logo.png" alt="logo">
				</div>
                <form method="POST" action="{{ route('login') }}" class="register-form" id="register-form">
                    @csrf
                    <h3>LOGIN</h3>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="form-wrapper">
                        <input type="text" name="email" placeholder="Email" class="form-control">
                        <i class="zmdi zmdi-email"></i>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-wrapper">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                        <i class="zmdi zmdi-lock"></i>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit">Login
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                    <div class="form-wrapper">
                        <h6><a href="{{ route('register') }}" class="signup-image-link">Belum memiliki akun?</a></h6>
                    </div>
                </form>
			</div>
		</div>
	</body>
</html>