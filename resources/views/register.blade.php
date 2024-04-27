@extends('./layouts/master')
@section('title', 'Sign up form')
@section('content')
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form action="{{ route('register') }}" method="POST" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name" />

                            <div>
                                @error('name')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" />

                            <div>
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                            <input type="phone" name="phone" id="phone" placeholder="Phone..." />

                            <div>
                                @error('phone')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address"><i class="zmdi zmdi-pin"></i></label>
                            <input type="text" name="address" id="address" placeholder="Address..." />
                            <div>
                                @error('address')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender"><i class="zmdi zmdi-male-female"></i></label><br><br>
                            <select name="gender" id="gender" class="form-select">
                                <option value="">Select gender...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select><br>

                            <div>
                                @error('gender')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password" />
                            <div>
                                @error('password')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"></i></label>

                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Repeat your password" />
                            <div>
                                @error('password_confirmation')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                                statements in <a href="#" class="term-service">Terms of service</a></label>
                            <div>
                                @error('agree-term')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="{{ route('auth#login') }}" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
@endsection
