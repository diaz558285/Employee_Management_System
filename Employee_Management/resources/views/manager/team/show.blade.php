<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ ucwords($employee->full_name) }}</h2>
                <p class="text-gray-600 text-sm mt-1">Employee ID: <span class="font-semibold">{{ $employee->employee_number }}</span></p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Main Profile Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <!-- Gradient Header -->
            <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 h-24"></div>
            
            <div class="px-8 pb-8">
                <!-- Avatar and Name Section -->
                <div class="flex flex-col sm:flex-row sm:items-end sm:gap-6 -mt-12 mb-8">
                    <div class="w-28 h-28 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-4xl font-bold border-4 border-white shadow-lg flex-shrink-0">
                        @php
                            $names = explode(' ', $employee->full_name);
                            $initials = strtoupper(substr($names[0], 0, 1)) . strtoupper(substr($names[count($names)-1] ?? '', 0, 1));
                        @endphp
                        {{ $initials }}
                    </div>
                    <div class="mt-4 sm:mt-0 pb-2">
                        <h1 class="text-2xl font-bold text-gray-900">{{ ucwords($employee->full_name) }}</h1>
                        <p class="text-gray-600 font-medium">{{ $employee->position }}</p>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Personal Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xs font-semibold uppercase text-yellow-600 mb-4">Personal Information</h3>
                        <div class="space-y-5">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Employee Number</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $employee->employee_number }}</p>
                            </div>
                            <div class="pt-4 border-t border-gray-200">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Position</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $employee->position }}</p>
                            </div>
                            <div class="pt-4 border-t border-gray-200">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Employment Type</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ ucfirst($employee->employment_type) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Work Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xs font-semibold uppercase text-yellow-600 mb-4">Work Information</h3>
                        <div class="space-y-5">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Department</p>
                                <div class="mt-2">
                                    @if($employee->department)
                                        <span class="inline-flex px-3 py-2 rounded-lg text-sm font-semibold bg-yellow-100 text-yellow-700">
                                            {{ $employee->department->name }}
                                        </span>
                                    @else
                                        <p class="text-lg font-semibold text-gray-400">—</p>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-200">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Date Hired</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ \Carbon\Carbon::parse($employee->date_hired)->format('M d, Y') }}</p>
                            </div>
                            <div class="pt-4 border-t border-gray-200">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Status</p>
                                <div class="mt-2">
                                    @if($employee->status === 'active')
                                        <span class="inline-flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium bg-emerald-100 text-emerald-700">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex px-3 py-2 rounded-lg text-sm font-medium bg-red-100 text-red-700">
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
                    <h3 class="text-xs font-semibold uppercase text-yellow-600 mb-5">Contact Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 mt-1">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-yellow-100 text-yellow-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.346.766.684 1.467.97 2.186.503 1.126 1.093 2.367 1.623 3.285l1.589-.794a1 1 0 011.08.102l3.114 3.115a1 1 0 01-1.414 1.414l-3.114-3.114-.788 1.576a1 1 0 01-1.313.363c-1.233-.662-2.515-1.303-3.677-2.365-.839-.742-1.734-1.78-2.367-2.955C2.571 10.75 2 9.3 2 8V3z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Phone</p>
                                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $employee->phone ?? '—' }}</p>
                                </div>
                            </div>
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 mt-1">
                                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-yellow-100 text-yellow-600">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $employee->user?->email ?? '—' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <a href="{{ route(auth()->user()->isManager() ? 'manager.team.index' : 'employee.profile') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-yellow-600 hover:bg-yellow-700 text-white transition-colors duration-200 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
    </div>
</x-app-layout>