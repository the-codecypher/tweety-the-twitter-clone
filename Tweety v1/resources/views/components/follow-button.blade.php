@unless(current_user()->is($user))
{{--    <form method="POST" action="/profiles/{{ $user->username }}/follow" >--}}
    <form method="POST" action="{{ route('follow', $user->username) }}" >
        @csrf
        <button type="submit"
                class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs"
        >
            {{ current_user()->following($user) ? 'Unfollow' : 'Follow' }}
        </button>
    </form>
@endunless
