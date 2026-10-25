<x-layout>

    <form action="{{ route('login') }}" method="POST" class="auth-form">
        @csrf

        <h2>Log In to Your Account</h2>

        <label for="email">Email:</label>
        <input
            type="email"
            name="email"
            required
            value="{{ old('email') }}"
        >

        <label for="password">Password:</label>
        <input
            type="password"
            name="password"
            required
        >

        <button type="submit" class="btn">
            Log in
        </button>

        <p class="switch">
            Don't have an account? <a href="{{ route('show.register') }}">Register</a>
        </p>

        <!-- validation errors -->
        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

    </form>

</x-layout>