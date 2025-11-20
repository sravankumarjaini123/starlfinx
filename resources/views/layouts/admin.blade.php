<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen">
    <!-- Sidebar (Separate File) -->
    @include('admin.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header (Separate File) -->
        @include('admin.partials.header')

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>
