{{--<x-admin-layout>--}}
    <x-slot name="title">Dashboard</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-600">
            <h3 class="text-gray-600 text-sm font-medium">Total Users</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total_users'] }}</p>
        </div>

        <!-- Active Users -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-600">
            <h3 class="text-gray-600 text-sm font-medium">Active Users</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['active_users'] }}</p>
        </div>

        <!-- Inactive Users -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-600">
            <h3 class="text-gray-600 text-sm font-medium">Inactive Users</h3>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['inactive_users'] }}</p>
        </div>

        <!-- Total Admins -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-600">
            <h3 class="text-gray-600 text-sm font-medium">Total Admins</h3>
            <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['total_admins'] }}</p>
        </div>
    </div>

    <div class="mt-10 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Welcome to Admin Panel</h2>
        <p class="text-gray-600">You are logged in as <strong>{{ auth()->user()->name }}</strong> ({{ ucfirst(auth()->user()->role) }})</p>
    </div>
{{--</x-admin-layout>--}}
