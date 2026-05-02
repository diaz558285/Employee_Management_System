<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $employee->full_name }}</h2>
                <p class="text-gray-600 text-sm mt-1">Employee ID: {{ $employee->employee_number }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Main Information Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 h-24"></div>
            <div class="px-8 pb-8">
                <div class="flex flex-col sm:flex-row sm:items-end sm:gap-6 -mt-12 mb-8">
                    <div class="w-24 h-24 rounded-full mt-4 bg-purple-100 flex items-center justify-center text-4xl font-semibold text-purple-600 border-4 border-white shadow">
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

                <!-- Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xs font-semibold uppercase text-purple-500 mb-4">Personal Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600">Employee Number</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $employee->employee_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Position</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $employee->position }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Employment Type</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ ucfirst($employee->employment_type) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Work Information -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xs font-semibold uppercase text-purple-500 mb-4">Work Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600">Department</p>
                                    <div class="mt-1">
                                        @if($employee->department)
                                            <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-700">
                                                {{ $employee->department->name }}
                                            </span>
                                        @else
                                            <p class="text-lg font-semibold text-gray-400">—</p>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Date Hired</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($employee->date_hired)->format('M d, Y') }}</p>
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
                                            <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                                Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-xs font-semibold uppercase text-purple-500 mb-4">Contact Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-center gap-3">
                            📞
                            <div>
                                <p class="text-sm text-gray-600">Phone</p>
                                <p class="font-medium text-gray-900">{{ $employee->phone ?? '—' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            📧
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-medium text-gray-900">{{ $employee->user?->email ?? '—' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <a href="{{ route('admin.employees.index') }}" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors duration-200">
            Back to Employees
        </a>
    </div>
</x-app-layout>