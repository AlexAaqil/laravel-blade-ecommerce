<x-general-layout class="Authentication">
    <div class="container Verify_email">
        <div class="header">
            <p>Thanks for signing up! Before getting started, kindly verify your email address by clicking on the link we just emailed to you.</p>
            <p>If you didn't receive the email, we will gladly send you another.</p>
        </div>

        @if(session('status') == 'verification-link-sent')
            <div class="alert alert-status">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="custom_form">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
    
                <button type="submit">Resend Verification Email</button>
            </form>
        </div>
    </div>
</x-general-layout>
