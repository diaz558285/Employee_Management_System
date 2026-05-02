<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Attendance Records</h2>
            <p class="text-gray-600 text-sm mt-1">Monitor and manage employee attendance</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-300 rounded-xl p-4 flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="font-semibold text-emerald-900">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Filter Section -->
        <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
            <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Employee</label>
                    <select name="employee_id" class="w-full border-2 border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition">
                        <option value="">All Employees</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" @selected(request('employee_id') == $emp->id)>{{ ucwords($emp->full_name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Date</label>
                    <input type="date" name="date" value="{{ request('date') }}"
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Status</label>
                    <select name="status" class="w-full border-2 border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition">
                        <option value="">All Status</option>
                        @foreach(['present','absent','late','half-day','on-leave'] as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst(str_replace('-', ' ', $s)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 items-end">
                    <button type="submit" class="flex-1 bg-black hover:bg-gray-700 text-white px-4 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wide transition-all duration-200 flex items-center justify-center gap-2">
                        Filter
                    </button>
                    <a href="{{ route('hr.attendance.create') }}"
                        class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wide transition-all duration-200 flex items-center gap-2 whitespace-nowrap">
                        Record
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-orange-300 text-black">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Employee</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Time In</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Time Out</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Hours</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($attendances as $att)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                            {{ strtoupper(substr($att->employee->full_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ ucwords($att->employee->full_name) }}</p>
                                            <p class="text-xs text-gray-600">{{ $att->employee->position }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ \Carbon\Carbon::parse($att->date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    @if($att->time_in)
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($att->time_in)->format('h:i A') }}</span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    @if($att->time_out)
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($att->time_out)->format('h:i A') }}</span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    @if($att->hours_worked > 0)
                                        {{ number_format($att->hours_worked, 1) }} hrs
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1.5 rounded-lg text-xs font-bold
                                        @if($att->status === 'present') bg-emerald-100 text-emerald-700
                                        @elseif($att->status === 'absent') bg-red-100 text-red-700
                                        @elseif($att->status === 'late') bg-yellow-100 text-yellow-700
                                        @elseif($att->status === 'half-day') bg-orange-100 text-orange-700
                                        @else bg-blue-100 text-blue-700 @endif">
                                        {{ ucfirst(str_replace('-', ' ', $att->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('hr.attendance.edit', $att) }}"
                                            class="text-orange-600 hover:font-bold text-xs font-semibold transition-all duration-200 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('hr.attendance.destroy', $att) }}"
                                            onsubmit="return confirm('Delete this record?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 hover:font-bold text-xs font-semibold transition-all duration-200 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-lg font-semibold text-gray-900">No attendance records found</p>
                                            <p class="text-gray-600 text-sm mt-1">Try adjusting your filters or add a new attendance record.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($attendances->hasPages())
            <div class="mt-8">
                {{ $attendances->links() }}
            </div>
        @endif
    </div>
</x-app-layout>