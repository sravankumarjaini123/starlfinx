@extends('layouts.app')

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Welcome -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-10 text-center">
            <h1 class="text-4xl font-bold text-gray-800">
                Welcome back, {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-600 mt-2 text-lg">Here's your system overview</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Total Admins -->
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 text-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-bold uppercase tracking-wider">Total Admins</p>
                        <p class="text-6xl font-extrabold mt-4">
                            {{ \App\Models\User::where('role', 'admin')->count() }}
                        </p>
                    </div>
                    <div class="bg-purple-700 bg-opacity-50 p-4 rounded-full">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21h3a2 2 0 002-2v-1a6 6 0 00-12 0v1a2 2 0 002 2h3m-6-4a9 9 0 1118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-bold uppercase tracking-wider">Total Users</p>
                        <p class="text-6xl font-extrabold mt-4">
                            {{ \App\Models\User::where('role', 'user')->count() }}
                        </p>
                    </div>
                    <div class="bg-blue-700 bg-opacity-50 p-4 rounded-full">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 01-6 0zm-6 0a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-gradient-to-br from-green-600 to-green-800 text-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-bold uppercase tracking-wider">Active Users or Admins</p>
                        <p class="text-6xl font-extrabold mt-4">
                            {{ \App\Models\User::where('status', 'active')->count() }}
                        </p>
                    </div>
                    <div class="bg-green-700 bg-opacity-50 p-4 rounded-full">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Inactive Users -->
            <div class="bg-gradient-to-br from-red-600 to-red-800 text-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-bold uppercase tracking-wider">Inactive Users or Admins</p>
                        <p class="text-6xl font-extrabold mt-4">
                            {{ \App\Models\User::where('status', 'inactive')->count() }}
                        </p>
                    </div>
                    <div class="bg-red-700 bg-opacity-50 p-4 rounded-full">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total All Users -->
        <div class="mt-12 text-center">
            <div class="inline-block bg-white rounded-2xl shadow-2xl px-12 py-8">
                <p class="text-gray-600 text-xl font-medium">Total Registered Admins & Users</p>
                <p class="text-7xl font-extrabold text-indigo-600 mt-4">
                    {{ \App\Models\User::count() }}
                </p>
            </div>
        </div>
    </div>
@endsection
