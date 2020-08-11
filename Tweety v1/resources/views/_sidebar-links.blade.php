<ul>
    <li>
        <a href="{{ route('home') }}" class="font-bold text-lg mb-4 block">Home</a>
        <a href="/explore" class="font-bold text-lg mb-4 block">Explore</a>
        <a href="{{ route('profile', auth()->user()) }}" class="font-bold text-lg mb-4 block">Profile</a>
        <form id="logout-form" action="{{ url('logout') }}" method="POST">
            @csrf
            <button type="submit" class="font-bold text-lg mb-4 block">Logout</button>
        </form>
    </li>
</ul>
