<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white border-b shadow-sm p-4">
    <div class="max-w-6xl mx-auto flex justify-between items-center">

        <div class="font-bold text-lg">
            {{ config('app.name','Laravel') }}
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium">
                Logout
            </button>
        </form>

    </div>
</nav>

<!-- MAIN PAGE -->
<main class="py-10">

    <div class="max-w-5xl mx-auto bg-white shadow rounded-xl p-8 grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- LEFT PANEL -->
        <div class="text-center">

            <img src="https://via.placeholder.com/120"
                 class="w-32 h-32 mx-auto rounded-full border-4 border-indigo-300 object-cover">

            <h2 class="mt-4 font-bold text-lg text-gray-900">
                {{ auth()->user()->name }}
            </h2>

            <p class="text-sm text-gray-500">
                {{ auth()->user()->email }}
            </p>

            <a href="#"
               class="inline-block mt-4 bg-indigo-500 text-white px-5 py-2 rounded-xl shadow hover:bg-indigo-600">
                Change Photo
            </a>

            <hr class="my-8">

            <h3 class="text-left font-semibold text-gray-800 mb-2">Navigation</h3>

            <ul class="space-y-2 text-left">
                <li><a href="#" class="text-blue-600">Profile</a></li>
                <li><a href="#" class="text-gray-600">Security</a></li>
                <li><a href="#" class="text-gray-600">Notifications</a></li>
            </ul>

        </div>

        <!-- RIGHT PANEL -->
        <div class="md:col-span-2">

            <h1 class="text-2xl font-bold mb-6">Update Profile</h1>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 text-red-700 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.update') }}">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- NAME -->
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Name</label>
                        <input type="text" name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <!-- MOBILE -->
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Mobile</label>
                        <input type="text" name="mobile"
                               value="{{ old('mobile', auth()->user()->mobile) }}"
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm text-gray-600 font-medium">New Password</label>
                        <input type="password" name="password"
                               class="w-full border rounded-lg px-4 py-2 mt-1"
                               placeholder="Leave blank to keep old password">
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                </div>

                <div class="mt-8">
                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-lg shadow">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>

    </div>

</main>

</body>
</html>
