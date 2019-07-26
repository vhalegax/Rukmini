@extends('layouts.frontend')
@section('title') Login @endsection
@section('content')

    <div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
        <div class="container">
                <div class="col-12">
                    <div class="text-center center">
                    <h2>Login Buyer</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container border bingkai">
                <div class="row">
                    <div class="col-12 ">
                    <form class="form-horizontal" method="POST" action="{{ route('pembeli.login.post') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">E-Mail Address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-outline-primary">
                                    Masuk
                                </button>

                                <a class="btn btn-outline-secondary" href="{{ route('password.request') }}">
                                    Lupa Kata Sandi?
                                </a>
                            </div>
                        </div>

                            <div class="col-md-8 col-md-offset-4">
                                Belum Punya Akun?<a href="{{route('pembeli.create')}}"><b> Buat Disini</b></a>
                            </div><br>

                            <div class="col-md-12">
                                <table width="100%">
                                    <tr>
                                        <td><hr /></td>
                                        <td style="width:1px; padding: 0 10px; white-space: nowrap;">ATAU</td>
                                        <td><hr /></td>
                                    </tr>
                                </table>​
                            </div>

                            <div class="col-md-12">
                                 <button type="submit" class="btn btn-outline-primary btn-block"> Masuk Dengan Facebook </button>
                            </div>
                            <br>

                            <div class="col-md-12">
                                 <button type="submit" class="btn btn-outline-danger btn-block"> Masuk Dengan Google </button>
                            </div>
                           
                            
                           
                        </div>
                    </form>
                 </div>
             </div>
          </div>


@endsection
