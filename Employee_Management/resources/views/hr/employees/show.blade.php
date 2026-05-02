<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $employee->full_name }}</h2>
                <p class="text-gray-600 text-sm mt-1">Employee ID: {{ $employee->employee_number }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Profile Header Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gradient-to-r from-orange-600 to-orange-700 h-24"></div>
            <div class="px-8 pb-8">
                <div class="flex flex-col sm:flex-row sm:items-end sm:gap-6 -mt-12 mb-8">
                    <div class="w-24 h-24 mt-4 rounded-full bg-orange-100 flex items-center justify-center text-4xl font-semibold text-orange-600 border-4 border-white shadow">
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

                <!-- Information Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Employment Information -->
                    <div>
                        <h3 class="text-xs font-semibold uppercase text-gray-500 mb-4">Employment Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-600">Employee Number</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $employee->employee_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Department</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $employee->department?->name ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Employment Type</p>
                                <p class="text-lg font-semibold text-gray-900">{{ ucfirst($employee->employment_type) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Date Hired</p>
                                <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($employee->date_hired)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Compensation Information -->
                    <div>
                        <h3 class="text-xs font-semibold uppercase text-gray-500 mb-4">Compensation</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-600">Basic Salary</p>
                                <p class="text-lg font-semibold text-gray-900">₱ {{ number_format($employee->basic_salary, 2) }}</p>
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
                </div>

                <!-- Contact Information -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-xs font-semibold uppercase text-gray-500 mb-4">Contact Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.346.766.684 1.467.97 2.186.503 1.126 1.093 2.367 1.623 3.285l1.589-.794a1 1 0 011.08.102l3.114 3.115a1 1 0 01-1.414 1.414l-3.114-3.114-.788 1.576a1 1 0 01-1.313.363c-1.233-.662-2.515-1.303-3.677-2.365-.839-.742-1.734-1.78-2.367-2.955C2.571 10.75 2 9.3 2 8V3z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Phone</p>
                                <p class="font-medium text-gray-900">{{ $employee->phone ?? '—' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-medium text-gray-900">{{ $employee->user?->email ?? '—' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Government IDs -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-xs font-semibold uppercase text-gray-500 mb-4">Government IDs</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600">SSS</p>
                            <p class="font-medium text-gray-900">{{ $employee->sss_number ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">PhilHealth</p>
                            <p class="font-medium text-gray-900">{{ $employee->philhealth_number ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Pag-IBIG</p>
                            <p class="font-medium text-gray-900">{{ $employee->pagibig_number ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">TIN</p>
                            <p class="font-medium text-gray-900">{{ $employee->tin_number ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Bank Account</p>
                            <p class="font-medium text-gray-900">{{ $employee->bank_account ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Leave Requests -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Leave Requests</h3>
                <p class="text-sm text-gray-600 mt-1">Latest 5 requests</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Dates</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Days</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($employee->leaveRequests->take(5) as $leave)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                        {{ ucfirst($leave->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }} → {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $leave->days_count }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($leave->status === 'approved')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                            Approved
                                        </span>
                                    @elseif($leave->status === 'rejected')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></path></svg>
                                            Rejected
                                        </span>
                                    @else
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    No leave requests
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Back Button -->
        <a href="{{ route('hr.employees.index') }}" class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors duration-200">
            Back to Employees
        </a>
    </div>
</x-app-layout>