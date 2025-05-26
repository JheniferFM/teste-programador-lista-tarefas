<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registrar</title>
  <style>
    /* Estilo geral */
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
    h2 {
      text-align: center;
      color: #1F3A73;
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
    }
    label {
      display: block;
      margin-bottom: 0.3rem;
      font-weight: 600;
      color: #333;
      font-size: 0.9rem;
    }
    input {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
      transition: border-color 0.3s;
    }
    input:focus {
      outline: none;
      border-color: #4A90E2;
    }
    button {
      width: 100%;
      background: #4A90E2;
      color: #fff;
      border: none;
      padding: 0.65rem;
      border-radius: 4px;
      font-size: 1.05rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background: #357ABD;
    }
    .alt-link {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    .alt-link a {
      color: #4A90E2;
      text-decoration: none;
      font-weight: 500;
    }
    .alt-link a:hover {
      text-decoration: underline;
    }
    .error {
      color: #e74c3c;
      font-size: 0.85rem;
      margin-top: -0.75rem;
      margin-bottom: 0.75rem;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Registrar</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <label for="name">Nome</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
      @error('name') <div class="error">{{ $message }}</div> @enderror

      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required>
      @error('email') <div class="error">{{ $message }}</div> @enderror

      <label for="password">Senha</label>
      <input id="password" type="password" name="password" required>
      @error('password') <div class="error">{{ $message }}</div> @enderror

      <label for="password_confirmation">Confirmar Senha</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required>
      @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror

      <button type="submit">Registrar</button>
    </form>

    <div class="alt-link">
      Já tem conta? <a href="{{ route('login') }}">Entrar</a>
    </div>
  </div>
</body>
</html>
