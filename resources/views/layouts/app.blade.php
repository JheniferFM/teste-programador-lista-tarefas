<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Minha Aplicação')</title>

  <style>
    /* RESET */
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* HEADER */
    header {
      background: linear-gradient(90deg, #023e8a, #0077b6);
      color: #fff;
      padding: 0.75rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      position: sticky;
      top: 0;
      z-index: 100;
    }
    header h1 {
      font-size: 1.6rem; font-weight: 700; user-select: none;
    }
    header nav {
      display: flex; gap: 1rem; flex-wrap: wrap;
    }
    header nav a,
    header nav button {
      background: rgba(255,255,255,0.1);
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      padding: 0.5rem 0.9rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }
    header nav a:hover,
    header nav button:hover {
      background: rgba(255,255,255,0.3);
      transform: translateY(-2px);
    }
    header nav .logout-btn {
      background: #ff595e;
    }
    header nav .logout-btn:hover {
      background: #e63946;
    }

    /* MAIN & FOOTER */
    main {
      flex: 1;
      max-width: 1000px;
      margin: 2rem auto;
      width: 100%;
      padding: 0 1rem;
    }
    footer {
      text-align: center;
      padding: 1rem 0;
      background: #e2e8f0;
      font-size: 0.9rem;
      color: #555;
    }

    @media (max-width: 600px) {
      header {
        flex-direction: column;
        gap: 0.5rem;
      }
      header nav {
        justify-content: center;
      }
    }
  </style>

  @stack('styles')
</head>
<body>
  <header>
    <h1>Minha Aplicação</h1>
    <nav>
      <a href="{{ route('tasks.index') }}">Minhas Tarefas</a>
      <a href="{{ route('tasks.create') }}">Criar Nova Tarefa</a>
      <form method="POST" action="{{ route('logout') }}" style="display:inline">
        @csrf
        <button type="submit" class="logout-btn">
          Sair ({{ auth()->user()->email }})
        </button>
      </form>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    © 2025 Minha Aplicação
  </footer>

  @stack('scripts')
</body>
</html>
