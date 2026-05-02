<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Edit Attendance</h2>
            <p class="text-gray-600 text-sm mt-1">{{ ucwords($attendance->employee->full_name) }} — {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('hr.attendance.update', $attendance) }}" class="space-y-6">
            @csrf @method('PUT')
            
            <!-- Main Card -->
            <div class="bg-white shadow-lg rounded-xl p-8 space-y-6">
                
                <!-- Employee Info (Read-only) -->
                <div class="bg-orange-50 rounded-lg p-6 border-2 border-orange-200">
                    <p class="text-xs font-bold text-orange-600 uppercase tracking-wide mb-2">Current Employee</p>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xl flex-shrink-0">
                            {{ strtoupper(substr($attendance->employee->full_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-900">{{ ucwords($attendance->employee->full_name) }}</p>
                            <p class="text-gray-600">{{ $attendance->employee->position }}</p>
                        </div>
                    </div>
                </div>

                <!-- Date and Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-3 text-black uppercase tracking-wide">
                            Date
                        </label>
                        <input type="date" name="date" value="{{ old('date', $attendance->date->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed"
                            readonly>
                        <p class="text-xs text-gray-500 mt-2">Date cannot be changed</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-3 text-black uppercase tracking-wide">
                            Status
                        </label>
                        <select name="status"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition">
                            <option value="present" @selected(old('status', $attendance->status) == 'present')>✓ Present</option>
                            <option value="absent" @selected(old('status', $attendance->status) == 'absent')>✗ Absent</option>
                            <option value="late" @selected(old('status', $attendance->status) == 'late')>⏱ Late</option>
                            <option value="half-day" @selected(old('status', $attendance->status) == 'half-day')>◐ Half Day</option>
                            <option value="on-leave" @selected(old('status', $attendance->status) == 'on-leave')>📋 On Leave</option>
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
                            <input type="time" name="time_in" value="{{ old('time_in', $attendance->time_in) }}"
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
                            <input type="time" name="time_out" value="{{ old('time_out', $attendance->time_out) }}"
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
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition resize-none">{{ old('notes', $attendance->notes) }}</textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <button type="submit"
                    class="flex-1 px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-lg transition-all duration-200 flex items-center justify-center gap-2 uppercase tracking-wide text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Record
                </button>
                <a href="{{ route('hr.attendance.index') }}"
                    class="px-6 py-3 border-2 border-gray-400 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold rounded-lg transition-colors duration-200 uppercase tracking-wide text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>