<x-general-layout class="Authentication">
    <div class="container Forgot_password">
        <div class="custom_form">
            <div class="header">
                <p>
                    Forgot your password? <br> No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input_group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter you Email Address" autofocus />
                    <span class="inline_alert">{{ $errors->first('email') }}</span>
                </div>

                <button type="submit">Email Password Reset Link</button>
            </form>
        </div>
    </div>
</x-general-layout>
