<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <ul>
                @foreach ($errors->all() as $error)
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div id="app">
        <div class="container" style="margin-top: 10%;">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Admin Login.
                        </div>
                        <div class="panel-body">
                            <form class="form" action="{{ route('adminLogin') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="row">
                                        <label for="Username" class="col-md-offset-2 col-md-8 text-center">Username.</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-8">
                                            <input type="email" class="form-control" name="admin_username" placeholder="Username" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="Password" class="col-md-offset-2 col-md-8 text-center">Password.</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-8">
                                            <input type="password" class="form-control" name="admin_password" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-8">
                                            <input type="submit" class="btn btn-primary" value="Login">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
