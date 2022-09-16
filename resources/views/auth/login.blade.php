<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Login</title>
        <link rel="icon" href="{{ asset('images/moblogo.png') }}" type="image/png" sizes="16x16" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet" />
        <body>
            <div class="mainheadingsection">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="leftloginwrapper">
                                <div class="leftloginformcontainer">
                                    <div class="leftformsectionboxheading">
                                        <img src="{{ asset('images/mainlogo3.png') }}" />
                                    </div>
                                    <div class="leftformsectioninnerdata">
                                        <h1>Welcome to <span>Cleaning Service</span></h1>
                                        <h6>Please sign in to continue</h6>
                                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="iconbox">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                        </div>
                                                        <input type="text" name="email" class="form-control customchangesemail email-input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter email" />

                                                        @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="iconbox">
                                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                                        </div>
                                                        <input type="Password" name="password" class="form-control customchangesemail password-input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Enter password" />

                                                        <div class="iconbox2">
                                                            @if ($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                            @endif
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary custombuttonchanges login">{{ __('Login') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="leftformsectionbox">
                                <img src="{{ asset('images/artistmainpic.png') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="{{ asset('js/bootstrap.min.js') }} "></script>
        </body>
    </head>
</html>
