@extends('layouts.app')

@section('header', 'Admins & Users Management')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div x-data="{
        open: {{ $errors->any() ? 'true' : 'false' }},
        isEdit: {{ old('isEdit') ? 'true' : 'false' }},
        editId: {{ old('editId') ?? 'null' }},
        editName: '{{ old('name') }}',
        editEmail: '{{ old('email') }}',
        editMobile: '{{ old('mobile') }}',
        editRole: '{{ old('role', 'user') }}',
        editStatus: '{{ old('status', 'active') }}',

        openAddModal() {
            this.isEdit = false;
            this.open = true;
        },

        openEditModal(user) {
            this.isEdit = true;
            this.editId = user.id;
            this.editName = user.name;
            this.editEmail = user.email;
            this.editMobile = user.mobile || '';
            this.editRole = user.role;
            this.editStatus = user.status || 'active';
            this.open = true;
        }
    }">


        <!-- Header + Add Button -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">All Users & Admins ({{ $admins->count() }})</h1>
                <button @click="openAddModal()"
                        class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-lg flex items-center gap-2">
                    Add New User
                </button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase">Mobile</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($admins as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">#{{ $user->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $user->profile_photo_url ?? asset('images/avatar.png') }}"
                                             class="h-10 w-10 rounded-full object-cover ring-2 ring-indigo-200">
                                        <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->mobile ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($user->status ?? 'inactive') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-4">
                                    <button @click="openEditModal({{ json_encode($user) }})"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</button>

                                    <form action="{{ route('admins.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete permanently?')"
                                                class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-16 text-gray-500 text-lg">No users found</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL -->
            <div x-show="open" x-transition.opacity
                 class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-4"
                 @click="open = false" x-cloak>

                <div @click.stop class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-screen overflow-y-auto p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-8" x-text="isEdit ? 'Edit User' : 'Add New User'"></h2>

                    <form id="userForm"
                          :action="isEdit
                          ? '{{ url('admins/users') }}' + '/' + editId
                          : '{{ route('admins.users.create') }}'"
                          method="POST">

                    @csrf

                        <template x-if="isEdit">
                            <input type="hidden" name="_method" value="POST">
                        </template>

                    @if($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                                <input type="text" name="name" required :value="isEdit ? editName : ''"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" required :value="isEdit ? editEmail : ''"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mobile</label>
                                <input type="text" name="mobile" :value="isEdit ? editMobile : ''"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                                <select name="role" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                                    <option value="admin" :selected="editRole === 'admin'">Admin</option>
                                    <option value="user" :selected="editRole === 'user'">User</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                                    <option value="active" :selected="editStatus === 'active'">Active</option>
                                    <option value="inactive" :selected="editStatus === 'inactive'">Inactive</option>
                                </select>
                            </div>

                            <!-- PASSWORD + CONFIRM PASSWORD: ONLY WHEN CREATING NEW USER -->
                            <template x-if="!isEdit">
                                <div class="md:col-span-2 space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                                        <input type="password" name="password" required minlength="8"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                               placeholder="Enter password">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                                        <input type="password" name="password_confirmation" required minlength="8"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                               placeholder="Confirm password">
                                    </div>
                                </div>
                            </template>

                        </div>

                        <div class="mt-10 flex justify-end gap-4">
                            <button type="button" @click="open = false"
                                    class="px-8 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-10 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-lg">
                                <span x-text="isEdit ? 'Update User' : 'Create Account'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
