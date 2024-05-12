<x-app-layout>
@include('partials.navbar')
<main class="Contact">
    <div class="container">
        @include('partials.messages')
        <div class="contact_details">
            <p>+254 711 894 267</p>
            <p>info@shea254.com</p>
        </div>

        <div class="contact_form">
            <div class="custom_form">
                <form action="{{ route('comments.store') }}" method="post">
                    @csrf

                    <div class="input_group">
                        <input type="text" name="full_name" id="full_name" placeholder="Full Name" value="{{ old('full_name') }}" autofocus />
                        <span class="inline_alert">{{ $errors->first('full_name') }}</span>
                    </div>
                    <div class="input_group">
                        <input type="email" name="email_address" id="email_address" placeholder="Email Address" value="{{ old('email_address') }}" />
                        <span class="inline_alert">{{ $errors->first('email_address') }}</span>
                    </div>
                    <div class="input_group">
                        <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" />
                        <span class="inline_alert">{{ $errors->first('phone_number') }}</span>
                    </div>
                    <div class="input_group">
                        <textarea name="message" id="message" cols="30" rows="7" placeholder="Enter your message">{{ old('message') }}</textarea>
                        <span class="inline_alert">{{ $errors->first('message') }}</span>
                    </div>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</main>
@include('partials.footer')
</x-app-layout>
