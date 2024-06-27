<x-general-layout class="Contact">
    <div class="container">
        <div class="text">
            <h1>Get in Touch</h1>
            
            <p>
                <span>{{ config('globals.phone_number') }}</span>
                <span>{{ config('globals.email') }}</span>
            </p>

            <p class="hours">
                <span>Mon - Fri</span>
                <span>08:00 AM - 06:00 PM</span>
            </p>
        </div>

        <div class="custom_form">
            <form action="{{ route('user-messages.store') }}" method="post">
                @csrf

                <div class="input_group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}">
                    <span class="inline_alert">{{ $errors->first('name') }}</span>
                </div>

                <div class="input_group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                    <span class="inline_alert">{{ $errors->first('email') }}</span>
                </div>

                <div class="input_group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" placeholder="254746055487" value="{{ old('phone_number') }}">
                    <span class="inline_alert">{{ $errors->first('phone_number') }}</span>
                </div>

                <div class="input_group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="7" placeholder="Enter your message">{{ session('success') ? '' : request('message', old('message')) }}</textarea>
                    <span class="inline_alert">{{ $errors->first('message') }}</span>
                </div>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</x-general-layout>