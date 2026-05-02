<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">My Team</h2>
            <p class="text-gray-600 text-sm mt-1">Manage and view your team members</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Section -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Search</label>
                    <input 
                        type="text"
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search employee name or ID..."
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                    >
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gray-700 hover:bg-gray-800 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Header Stats -->
        <div class="mb-6">
            <p class="text-sm text-gray-600">
                Showing <span class="font-semibold text-gray-900">{{ $employees->count() }}</span> of <span class="font-semibold text-gray-900">{{ $employees->total() }}</span> team members
            </p>
        </div>

        <!-- Grid or Table View -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @forelse($employees as $emp)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow duration-200">
                    <div class="p-6">
                        <!-- Employee Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-semibold text-sm flex-shrink-0">
                                    @php
                                        $names = explode(' ', $emp->full_name);
                                        $initials = strtoupper(substr($names[0], 0, 1)) . strtoupper(substr($names[count($names)-1] ?? '', 0, 1));
                                    @endphp
                                    {{ $initials }}
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ ucwords($emp->full_name) }}</h3>
                                    <p class="text-sm text-gray-600">{{ $emp->position }}</p>
                                </div>
                            </div>
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $emp->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($emp->status) }}
                            </span>
                        </div>

                        <!-- Employee Details -->
                        <div class="space-y-3 mb-4 pb-4 border-b border-gray-200">
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                <span class="text-gray-600">{{ $emp->department?->name ?? 'No Department' }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-gray-600">ID: {{ $emp->employee_number }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-600">Hired: {{ \Carbon\Carbon::parse($emp->date_hired)->format('M d, Y') }}</span>
                            </div>
                        </div>

                        <!-- View Button -->
                        <a href="{{ route('manager.team.show',$emp) }}" class="block w-full px-4 py-2.5 text-center bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View Profile
                        </a>
                    </div>
                </div>
            @empty
                <div class="lg:col-span-2 bg-white rounded-lg shadow p-12 text-center">
                    <div class="flex flex-col items-center gap-2">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-gray-500 font-medium">No team members assigned</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($employees->hasPages())
            <div class="mt-8">
                {{ $employees->links() }}
            </div>
        @endif
    </div>
</x-app-layout>