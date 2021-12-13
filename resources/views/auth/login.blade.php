<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    </head>
    <body class="bg-primary">
    <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
    <main>     
    <div class="container">
        <div class="row justify-content-center">
        <div style="margin-top: 6%;" class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">{{ __('Iniciar Sesion') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-3">
                                <input id="inputEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="inputEmail" >{{ __('Correo Electronico') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        
                        <br>
                        <div class="form-floating mb-3">
                            
                            <input id="inputPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            <label for="inputPassword" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="inputRememberPassword" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="inputRememberPassword">
                                {{ __('Recordarme') }}
                            </label>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-2 mb-0">   
                        
                            @if (Route::has('password.request'))
                                <a class="small btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste Tu Contraseña?') }}
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary">
                                {{ __('Iniciar Sesion') }}
                            </button>
                        </div>
                    </form>
                    <br>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="register">No tienes Una Cuenta? Registrate Aqui!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/scripts.js"></script>
</body>
</html>


