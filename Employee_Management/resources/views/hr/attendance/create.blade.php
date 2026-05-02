<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Record Attendance</h2>
            <p class="text-gray-600 text-sm mt-1">Add a new attendance entry</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 px-6 py-4 rounded-xl mb-6 flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold mb-2">Please fix the following errors:</p>
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('hr.attendance.store') }}" class="space-y-6">
            @csrf
            
            <!-- Main Card -->
            <div class="bg-white shadow-lg rounded-xl p-8 space-y-6">
                <!-- Employee Selection -->
                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-3 text-black uppercase tracking-wide">
                        Select Employee <span class="text-red-500">*</span>
                    </label>
                    <select name="employee_id"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition"
                        required>
                        <option value="">— Choose an employee —</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" @selected(old('employee_id') == $emp->id)>
                                {{ ucwords($emp->full_name) }} — {{ $emp->position }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date and Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-3 text-black uppercase tracking-wide">
                            Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-3 text-black uppercase tracking-wide">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition"
                            required>
                            <option value="present" @selected(old('status') == 'present')>✓ Present</option>
                            <option value="absent" @selected(old('status') == 'absent')>✗ Absent</option>
                            <option value="late" @selected(old('status') == 'late')>⏱ Late</option>
                            <option value="half-day" @selected(old('status') == 'half-day')>◐ Half Day</option>
                            <option value="on-leave" @selected(old('status') == 'on-leave')>📋 On Leave</option>
                        </select>
                    </div>
                </div>

                <!-- Time Entry -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-3 text-black uppercase tracking-wide">
                            Time In
                        </label>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <input type="time" name="time_in" value="{{ old('time_in') }}"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-3 text-black uppercase tracking-wide">
                            Time Out
                        </label>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <input type="time" name="time_out" value="{{ old('time_out') }}"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-3 text-black uppercase tracking-wide">
                        Notes
                    </label>
                    <textarea name="notes" rows="4"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition resize-none"
                        placeholder="Add any additional notes about the attendance...">{{ old('notes') }}</textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <button type="submit"
                    class=" px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-lg transition-all duration-200 flex items-center justify-center gap-2 uppercase tracking-wide text-sm">
                    Record Attendance
                </button>
                <a href="{{ route('hr.attendance.index') }}"
                    class="px-6 py-3 border-2 border-gray-300 bg-gray-400 hover:bg-gray-500 text-black font-bold rounded-lg transition-colors duration-200 uppercase tracking-wide text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>