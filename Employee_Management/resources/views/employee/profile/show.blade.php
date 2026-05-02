<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">My Profile</h2>
            <p class="text-gray-600 text-sm mt-1">View and manage your personal information</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="font-medium text-emerald-900">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Profile Header Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 h-24"></div>
            <div class="px-8 pb-8">
                <div class="flex flex-col sm:flex-row sm:items-end sm:gap-6 -mt-12 mb-8">
                    <div class="w-24 h-24 rounded-full mt-4 bg-indigo-100 flex items-center justify-center text-4xl font-semibold text-indigo-600 border-4 border-white shadow">
                        @php
                            $names = explode(' ', $employee->full_name);
                            $initials = strtoupper(substr($names[0], 0, 1)) . strtoupper(substr($names[count($names)-1] ?? '', 0, 1));
                        @endphp
                        {{ $initials }}
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ ucwords($employee->full_name) }}</h1>
                        <p class="text-gray-600">{{ $employee->position }}</p>
                    </div>
                </div>

                <!-- User Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pb-6 border-b border-gray-200">
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Employee ID</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $employee->employee_number }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employment Information -->
        <div class="bg-white rounded-lg shadow p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4m0 0L14 6m2-2l2 2M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Employment Information</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Position</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $employee->position }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Department</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $employee->department?->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Employment Type</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ ucfirst($employee->employment_type) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Date Hired</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ \Carbon\Carbon::parse($employee->date_hired)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <div class="mt-1">
                        @if($employee->status === 'active')
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                Active
                            </span>
                        @else
                            <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                                Inactive
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information Form -->
        <div class="bg-white rounded-lg shadow p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Contact Information</h3>
            </div>

            <form method="POST" action="{{ route('employee.profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">
                            Phone Number
                        </label>
                        <input 
                            type="tel"
                            id="phone"
                            name="phone" 
                            value="{{ old('phone', $employee->phone) }}" 
                            placeholder="+63 9XX XXXX XXX"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                        @error('phone')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-900 mb-2">
                        Address
                    </label>
                    <textarea 
                        id="address"
                        name="address" 
                        rows="4"
                        placeholder="Street address, city, province"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"
                    >{{ old('address', $employee->address) }}</textarea>
                    @error('address')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex gap-3">
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                        ✓ Save Changes
                    </button>
                </div>

                {{-- Password Change Section --}}
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Change Password</h3>
                            <p class="text-sm text-gray-500">Leave blank to keep your current password</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Current Password</label>
                            <input type="password" name="current_password"
                                placeholder="Enter current password"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('current_password') border-red-500 @enderror">
                            @error('current_password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">New Password</label>
                            <input type="password" name="new_password"
                                placeholder="Minimum 8 characters"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('new_password') border-red-500 @enderror">
                            @error('new_password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation"
                                placeholder="Repeat new password"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            Update Password
                        </button>
                    </div>
                </div>

            </form>
        </div>
            </form>
        </div>

        <!-- Additional Information -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex gap-3">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18.243 3.579A2 2 0 0016.97 3H3.03a2 2 0 00-1.272.579m16.485 0l-7.56 7.56a2 2 0 01-2.826 0l-7.56-7.56m16.485 0A2 2 0 0016.97 1H3.03a2 2 0 00-2 2v14a2 2 0 002 2h13.94a2 2 0 002-2V3z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold text-blue-900">Need to update other information?</p>
                    <p class="text-blue-800 text-sm mt-1">Contact the HR department for changes to your position, department, employment type, or other employment details.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>