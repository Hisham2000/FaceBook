    {{-- <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout> --}}


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{URL::asset('public/assets/Css/font-awesome.min.css')}}">
        <link href="{{ URL::asset('public/assets/Css/Register.css')}}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <div class="container col-xs-1 text-center" style="width: 50%">
            <h1 class="display-4">facebook</h1>
            <div class="form-group">
                <h2 class="h2">Create a new account</h2>
                <p class="lead">it's quickly and easy</p>
                <hr style="color: darkgray;" >
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <br>
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <input class="form-control "  name="name" type="text" placeholder="Name..." required>
                    <input class="form-control "  name="email" type="text" placeholder="Email adress" required>
                    <input class="form-control "  name="password" type="Password" placeholder="Password" required>
                    <input class="form-control "  name="password_confirmation" type="Password" placeholder="Confirm Password" required>
                    
                    <div class="container">
                        <div class="form-group row">
                            <label for="bDate" class="col-sm-3 col-form-label lead">Date of Birth</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="date" id="bDate" name="bDate" required class="calender">    
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="container" style="width: 90%">
                        <div class="form-group row">
                            <label for="gender" class="col-sm-2 col-form-label lead" >Gender</label>
                            <div class="male form-chick col-sm-5">
                                <label for="male" class="lead form-check-label">Male</label>
                                <input type="radio" name="gender" value="male" id="male">
                            </div>
                            <div class="female col-sm-5">
                                <label for="female" class="lead form-check-label">Female</label>
                                <input type="radio" name="gender" value="female" id="female">
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Sign Up" name="submit" class="btn btn-success" style="width: 50%;font-weight: bold">
                </form>
                <a href="{{ route('login')}}">Already have an account?</a>
            </div>
        </div>
    </body>
    </html>