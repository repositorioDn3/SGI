<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acessar Sistema</title>

<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/sweetalert2.min.css')}}">
</head>
<body class="hold-transition login-page" style="
background-image: url('/img/realestate.jpg'); background-size: cover;">

    <div class="login-box">
      <div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
              <a href="/" class="h1">SGI</a>
              <p class="login-box-msg h5 mt-4">Sistema de Gestão Imóbiliaria</p>
            </div>
            <div class="card-body">
             
              <form action="{{route('acessar')}}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="">E-mail:</label>
                  <input type="email" value="admin@gmail.com" name="email"  class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                 @error('email') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="senha">Senha:</label>
                  <input type="password" value="rootuser01" name="senha"  class="form-control @error('senha') is-invalid @enderror" placeholder="Senha">
                  @error('senha') <span class="text-danger">{{$message}}</span> @enderror

                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input type="checkbox" id="remember">
                      <label for="remember">
                        Lembrar - Me
                      </label>
                    </div>
                  </div>
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                  </div>
                </div>
              </form>
        
         
        
              <p class="mb-1">
                <a href="forgot-password.html">Recuperar Senha</a>
              </p>
          
            </div>
          </div>
    
        </div>
    
    </div>
    
 <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dist/js/sweetalert2.all.min.js')}}"></script>


 
</body>
</html>
