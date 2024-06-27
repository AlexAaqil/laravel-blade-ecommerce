<x-general-layout class="UserDashboard">
    <div class="container">
        <h1>Hi {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h1>
        
        <div class="custom_form">
            <div class="button_wrapper">
                <a href="{{ route('profile.edit') }}" class="btn">Edit Profile</a>
            </div>

            <form action="{{ route('logout') }}" method="post">
                @csrf

                <button type="submit" class="btn_danger">Logout</button>
            </form>
        </div>
    </div>
</x-general-layout>
