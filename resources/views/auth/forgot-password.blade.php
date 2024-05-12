<x-general-layout class="Authentication">
    <div class="container forgot_password">
        <div class="custom_form">
            <p>
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input_group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus />
                    <span class="inline_alert">{{ $errors->first('email') }}</span>
                </div>

                <button type="submit">Email Password Reset Link</button>
            </form>
        </div>
    </div>
</x-general-layout>
