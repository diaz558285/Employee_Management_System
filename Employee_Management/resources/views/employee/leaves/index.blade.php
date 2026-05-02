<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">My Leave Requests</h2>
            <p class="text-gray-600 text-sm mt-1">View and manage your leave requests</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-lg p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="font-medium text-emerald-900">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Header with Action Button -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Leave Requests</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $leaves->total() }} request{{ $leaves->total() !== 1 ? 's' : '' }} total</p>
            </div>
            <a href="{{ route('employee.leaves.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                + New Request
            </a>
        </div>

        <!-- Stats -->
        @php
            $allLeaves = auth()->user()->employee?->leaveRequests;
            $stats = [
                ['label' => 'Approved', 'count' => $allLeaves?->where('status', 'approved')->count() ?? 0, 'color' => 'emerald'],
                ['label' => 'Pending', 'count' => $allLeaves?->where('status', 'pending')->count() ?? 0, 'color' => 'yellow'],
                ['label' => 'Rejected', 'count' => $allLeaves?->where('status', 'rejected')->count() ?? 0, 'color' => 'red'],
            ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            @foreach($stats as $stat)
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-{{ $stat['color'] }}-100 rounded-lg flex items-center justify-center">
                            <span class="text-lg font-bold text-{{ $stat['color'] }}-600">{{ $stat['count'] }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-indigo-300 border-b border-gray-200 text-black">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Start Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">End Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Days</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($leaves as $leave)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                        {{ ucfirst($leave->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        {{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    {{ $leave->days_count }} day{{ $leave->days_count !== 1 ? 's' : '' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($leave->status === 'approved')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                            ✓ Approved
                                        </span>
                                    @elseif($leave->status === 'rejected')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            ✕ Rejected
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                            Pending...
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('employee.leaves.show', $leave) }}" class="text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200 flex items-center gap-1">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <p class="text-gray-500 font-medium">No leave requests yet</p>
                                        <a href="{{ route('employee.leaves.create') }}" class="text-blue-600 hover:underline text-sm mt-2">Submit your first leave request →</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($leaves->hasPages())
            <div class="mt-6">
                {{ $leaves->links() }}
            </div>
        @endif
    </div>
</x-app-layout>