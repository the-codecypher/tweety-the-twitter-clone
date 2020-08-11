<div class="border border-blue-400 rounded-lg py-6 px-8 mb-8">
    <form action="/tweets" method="POST">
        @csrf
        <textarea
            name="body"
            class="w-full bg-blue-100 placeholder-blue-900"
            placeholder="Tweet something..."
            required
        ></textarea>

        <hr class="my-4">

        <footer class="flex justify-between">
            <img
                src="{{ auth()->user()->avatar }}"
                alt="Your Avatar"
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
            <button
                type="submit"
                class="bg-blue-500 rounded-lg shadow hover:bg-blue-700 px-10 text-sm text-white"
            >Post Tweet</button>
        </footer>
    </form>

    @error('body')
        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
    @enderror
</div>
