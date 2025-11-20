<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="px-6 py-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">{{ $title ?? 'Admin Panel' }}</h2>
        <div class="flex items-center space-x-4">
            <span class="text-gray-600">Welcome,</span>
            <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
            <span class="text-sm text-gray-500">({{ auth()->user()->role }})</span>
        </div>
    </div>
</header>
