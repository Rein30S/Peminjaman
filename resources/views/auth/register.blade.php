<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Halaman Registrasi</title>
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
                <form method="POST" action="{{ route('register') }}" class="register-form" id="login-form">
                    @csrf
                    <h3>Registrasi</h3>
                    <div class="form-wrapper">
                        <input type="text" name="nama_lengkap" placeholder="Nama" class="form-control">
                        @error('nama_lengkap')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-wrapper">
                        <label>Jenis Kelamin</label><br>
                        <input type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki">
                        <label for="laki-laki">Laki-laki</label><br>
                        <input type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                        <label for="perempuan">Perempuan</label>
                        @error('jenis_kelamin')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-wrapper">
                        <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control">
                        <i class="zmdi zmdi-calendar"></i>
                        @error('tanggal_lahir')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-wrapper">
                        <input type="text" name="alamat" placeholder="Alamat" class="form-control">
                        <i class="zmdi zmdi-pin"></i>
                        @error('alamat')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-wrapper">
                        <input type="text" name="nomor_telepon" placeholder="Nomor Telepon Diawali Dengan 62" class="form-control">
                        <i class="zmdi zmdi-phone"></i>
                        @error('nomor_telepon')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-wrapper">
                        <input type="text" name="email" placeholder="Email" class="form-control">
                        <i class="zmdi zmdi-email"></i>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-wrapper">
                        <input type="password" name="password" placeholder="Password 8 Digit" class="form-control">
                        <i class="zmdi zmdi-lock"></i>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-wrapper">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="form-control">
                        <i class="zmdi zmdi-lock"></i>
                        @error('password_confirmation')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @error('all')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <button type="submit">Register
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                    <div class="form-wrapper">
                        <h6><a href="{{ route('login') }}" class="signup-image-link">Sudah menjadi member?</a></h6>
                    </div>
                </form>
			</div>
		</div>
	</body>
</html>