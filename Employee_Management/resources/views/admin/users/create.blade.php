<x-app-layout>
<x-slot name="header">
    <div>
        <h2 class="text-3xl font-bold text-gray-900">Add User</h2>
        <p class="text-gray-600 text-sm mt-1">Create Admin, HR, or Manager accounts</p>
    </div>
</x-slot>

<div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-blue-700 text-sm">
            Employee accounts are automatically created by HR when adding an employee record with a default password of <strong>password123</strong>.
            This form is only for creating <strong>Admin</strong>, <strong>HR</strong>, and <strong>Manager</strong> accounts.
        </p>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
        @csrf

        <div class="bg-white shadow rounded-lg p-8 space-y-6">

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('name') border-red-500 @enderror">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('password') border-red-500 @enderror">
                @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Confirm Password <span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Role <span class="text-red-500">*</span></label>
                <select name="role"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="">— Select Role —</option>
                    <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                    <option value="hr" @selected(old('role') === 'hr')>HR Staff</option>
                    <option value="manager" @selected(old('role') === 'manager')>Manager</option>
                </select>
                @error('role')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Department</label>
                <select name="department_id"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="">— None —</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" @selected(old('department_id') == $dept->id)>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="flex gap-4 pt-2">
            <button type="submit"
                class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create User
            </button>
            <a href="{{ route('admin.users.index') }}"
                class="px-6 py-2.5 border border-gray-300 bg-gray-300 hover:bg-gray-400 text-black font-medium rounded-lg transition">
                Cancel
            </a>
        </div>
    </form>
</div>
</x-app-layout>