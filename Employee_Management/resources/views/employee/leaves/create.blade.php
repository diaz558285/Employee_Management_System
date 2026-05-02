<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Submit Leave Request</h2>
            <p class="text-gray-600 text-sm mt-1">Request time off from work</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('employee.leaves.store') }}" class="space-y-6">
            @csrf

            <!-- Leave Type Selection -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Leave Type</h3>
                </div>

                <label for="type" class="block text-sm font-semibold text-gray-900 mb-2">
                    Select Leave Type
                    <span class="text-red-500">*</span>
                </label>
                <select 
                    id="type"
                    name="type" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition @error('type') border-red-500 @enderror"
                >
                    <option value="">— Select Type —</option>
                    <option value="sick" @selected(old('type') === 'sick')>
                        🤒 Sick Leave
                    </option>
                    <option value="vacation" @selected(old('type') === 'vacation')>
                        🏖️ Vacation
                    </option>
                    <option value="emergency" @selected(old('type') === 'emergency')>
                        🚨 Emergency Leave
                    </option>
                    <option value="maternity" @selected(old('type') === 'maternity')>
                        👶 Maternity Leave
                    </option>
                    <option value="paternity" @selected(old('type') === 'paternity')>
                        👨‍👧 Paternity Leave
                    </option>
                    <option value="unpaid" @selected(old('type') === 'unpaid')>
                        📋 Unpaid Leave
                    </option>
                </select>
                @error('type')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror

                <!-- Leave Type Info -->
                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm text-blue-900">
                        <span class="font-semibold">Note:</span> Different leave types may have different approval requirements. Your manager will review your request.
                    </p>
                </div>
            </div>

            <!-- Date Selection -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Leave Period</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-semibold text-gray-900 mb-2">
                            Start Date
                            <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date"
                            id="start_date"
                            name="start_date" 
                            value="{{ old('start_date') }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition @error('start_date') border-red-500 @enderror"
                        >
                        @error('start_date')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-semibold text-gray-900 mb-2">
                            End Date
                            <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date"
                            id="end_date"
                            name="end_date" 
                            value="{{ old('end_date') }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition @error('end_date') border-red-500 @enderror"
                        >
                        @error('end_date')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Reason Section -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Additional Information</h3>
                </div>

                <label for="reason" class="block text-sm font-semibold text-gray-900 mb-2">
                    Reason for Leave
                    <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="reason"
                    name="reason" 
                    rows="5"
                    placeholder="Please provide a detailed reason for your leave request..."
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none @error('reason') border-red-500 @enderror"
                >{{ old('reason') }}</textarea>
                @error('reason')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-2">Be specific about your reason so your manager can make an informed decision.</p>
            </div>

            <!-- Info Box -->
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-amber-900 text-sm">Important</p>
                        <p class="text-amber-800 text-sm mt-1">Your leave request will be submitted to your manager for review. You will be notified once a decision is made.</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">

                    Submit Request
                </button>
                <a href="{{ route('employee.leaves.index') }}" class="px-6 py-2.5 border border-gray-400 bg-gray-300 hover:bg-gray-400 text-black font-medium rounded-lg transition-colors duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>