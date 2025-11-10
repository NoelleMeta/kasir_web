<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
	<style>
		* { box-sizing: border-box; }
		body {
			font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
			margin: 0;
			background: #f8fafc;
			color: #0f172a;
			/* Prevent layout shift */
			overflow-x: hidden;
			min-height: 100vh;
		}
		.container {
			max-width: 360px;
			margin: 60px auto;
			padding: 0 16px;
			width: 100%;
			/* Prevent centering animation */
			position: relative;
		}
		.card {
			background: white;
			border-radius: 12px;
			padding: 20px;
			box-shadow: 0 1px 2px rgba(0,0,0,0.06);
			width: 100%;
			/* Prevent card stretching */
			position: relative;
		}
		.title { font-size: 20px; font-weight: 700; margin-bottom: 16px; text-align: center; }
		.label { font-size: 13px; color: #334155; font-weight: 600; margin-bottom: 6px; display: block; }
		.input { width: 100%; padding: 10px 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; box-sizing: border-box; }
		.password-container { position: relative; width: 100%; }
		.password-input { padding-right: 40px; width: 100%; box-sizing: border-box; }
		.password-toggle { position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; font-size: 16px; padding: 4px; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; }
		.password-toggle:hover { color: #334155; }
		.password-toggle svg { width: 16px; height: 16px; }
		.row { margin-bottom: 12px; width: 100%; }
		.btn { width: 100%; padding: 10px 14px; background: #0ea5e9; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; border: none; cursor: pointer; box-sizing: border-box; }
		.error { color: #dc2626; font-size: 13px; margin-top: 6px; }
		form { width: 100%; }
		@media (max-width: 768px) {
			.container {
				margin: 40px auto;
				padding: 0 12px;
			}
			.card {
				padding: 18px;
			}
			.title {
				font-size: 18px;
			}
			.input {
				font-size: 16px; /* Prevent zoom on iOS */
				padding: 12px;
			}
			.btn {
				font-size: 16px;
				padding: 12px 14px;
			}
		}

		@media (max-width: 480px) {
			.container {
				margin: 30px auto;
				padding: 0 10px;
			}
			.card {
				padding: 16px;
			}
			.title {
				font-size: 16px;
				margin-bottom: 12px;
			}
			.label {
				font-size: 12px;
			}
			.input {
				font-size: 14px;
				padding: 10px;
			}
			.btn {
				font-size: 14px;
				padding: 10px 12px;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="title">Masuk</div>

			@if(session('session_expired'))
				<div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 16px; font-size: 13px;">
					<strong>⚠️ Session Expired</strong><br>
					<small>Silakan login kembali untuk melanjutkan.</small>
				</div>
			@endif

			<form method="POST" action="{{ route('login.attempt') }}">
				@csrf
				<div class="row">
					<label class="label" for="username">Username</label>
					<input class="input" type="text" id="username" name="username" value="{{ old('username') }}" autofocus required>
					@error('username')
						<div class="error">{{ $message }}</div>
					@enderror
				</div>
				<div class="row">
					<label class="label" for="password">Password</label>
					<div class="password-container">
						<input class="input password-input" type="password" id="password" name="password" required>
						<button type="button" class="password-toggle" onclick="togglePassword('password')">
							<span id="password-icon">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
									<circle cx="12" cy="12" r="3"></circle>
								</svg>
							</span>
						</button>
					</div>
					@error('password')
						<div class="error">{{ $message }}</div>
					@enderror
				</div>
				<div class="row" style="display:flex; align-items:center; gap:8px;">
					<input type="checkbox" id="remember" name="remember" value="1">
					<label class="label" for="remember" style="margin:0; font-weight:500;">Ingat saya</label>
				</div>
				<button class="btn" type="submit">Masuk</button>
			</form>
		</div>
	</div>

	<script>
		function togglePassword(inputId) {
			const input = document.getElementById(inputId);
			const icon = document.getElementById(inputId + '-icon');

			if (input.type === 'password') {
				input.type = 'text';
				icon.innerHTML = `
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
						<line x1="1" y1="1" x2="23" y2="23"></line>
					</svg>
				`;
			} else {
				input.type = 'password';
				icon.innerHTML = `
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
						<circle cx="12" cy="12" r="3"></circle>
					</svg>
				`;
			}
		}
	</script>
</body>
</html>


