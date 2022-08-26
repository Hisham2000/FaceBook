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
    <link href="{{ URL::asset('assets/Css/Register.css')}}" rel="stylesheet">
</head>
<body>
    <h1>facebook</h1>
    <div>
        <h2>Create a new account</h2>
        <p>it's quickly and easy</p>
        <hr style="color: darkgray;" >
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <br>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <input type="text" name="name" placeholder="Name...." required>
            <input type="text" name="email" placeholder="Mobile number or email adress" required>
            <input type="password" name="password" placeholder="New password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <label for="bDate">Date of Birth <span>&#63;</span> </label>
            <input type="date" id="bDate" name="bDate" required>
            <br>
            <label for="gender">Gender <span>&#63;</span></label>
            <div class="male">
                <label for="male">Male</label>
                <input type="radio" name="gender" value="male" id="male">
            </div>
            <div class="female">
                <label for="female">Female</label>
                <input type="radio" name="gender" value="female" id="female">
            </div>
            
            <br>
            <input type="submit" value="Sign Up" name="submit">
        </form>
        <a href="{{ route('login')}}">Alreade have an account?</a>
    </div>
</body>
</html>