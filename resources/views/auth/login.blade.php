<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Entrar</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .form-container {
      background: #ffffff;
      padding: 2rem 2.5rem;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      width: 340px;
    }
    .form-container h2 {
      text-align: center;
      color: #1F3A73;
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
    }
    label {
      display: block;
      margin-bottom: 0.4rem;
      color: #2C3E50;
      font-weight: 600;
      font-size: 0.9rem;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.5rem 0.75rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }
    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #4A90E2;
      outline: none;
    }
    .checkbox-group {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
      font-size: 0.9rem;
      color: #2C3E50;
      cursor: pointer;
    }
    .checkbox-group input[type="checkbox"] {
      margin-right: 0.5rem;
    }
    .error {
      color: #e74c3c;
      font-size: 0.8rem;
      margin-top: -0.8rem;
      margin-bottom: 0.8rem;
    }
    button {
      width: 100%;
      background-color: #4A90E2;
      border: none;
      padding: 0.7rem;
      color: white;
      font-size: 1rem;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #357ABD;
    }
    .switch-link {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    .switch-link a {
      color: #4A90E2;
      text-decoration: none;
      font-weight: 600;
    }
    .switch-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Entrar</h2>
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
      @error('email') <div class="error">{{ $message }}</div> @enderror

      <label for="password">Senha</label>
      <input id="password" type="password" name="password" required autocomplete="current-password" />
      @error('password') <div class="error">{{ $message }}</div> @enderror

      <label class="checkbox-group" for="remember">
        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
        Lembrar-me
      </label>

      <button type="submit">Entrar</button>
    </form>

    <div class="switch-link">
      Não tem conta? <a href="{{ route('register') }}">Registrar</a>
    </div>
  </div>
</body>
</html>
