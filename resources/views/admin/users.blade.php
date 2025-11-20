{{-- resources/views/users/index.blade.php --}}
@extends('layouts.app')

@section('header', 'All Users List')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">All Users ({{ $users->count() }})</h1>
            <p class="text-gray-600 mt-2">Complete list of registered users</p>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-lg shadow-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Mobile</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 text-sm text-gray-700">#{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $user->profile_photo_url ?? asset('images/avatar.png') }}"
                                         alt="{{ $user->name }}"
                                         class="h-12 w-12 rounded-full object-cover ring-2 ring-indigo-200 shadow">
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->mobile ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-4 py-1.5 text-xs font-bold rounded-full
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-4 py-1.5 text-xs font-bold rounded-full
                                    {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($user->status ?? 'inactive') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-4">
                                <a href="{{ route('admins.users.edit', $user->id) }}"
                                   class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admins.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Delete this user permanently?')"
                                            class="text-red-600 hover:text-red-900 font-medium text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-16 text-gray-500">
                                <div class="text-2xl">No users found</div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
