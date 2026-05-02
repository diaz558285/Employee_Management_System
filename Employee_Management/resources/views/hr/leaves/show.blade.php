<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Leave Request Details</h2>
            <p class="text-gray-600 text-sm mt-1">{{ $leaveRequest->employee?->full_name }}</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-8 py-6">
                <h1 class="text-2xl font-bold text-white">{{ ucwords($leaveRequest->employee?->full_name) }}</h1>
                <p class="text-orange-100 mt-1">Leave Request #{{ $leaveRequest->id }}</p>
            </div>

            <!-- Content -->
            <div class="p-8 space-y-6">
                <!-- Request Details -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Request Details</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600">Leave Type</p>
                            <p class="text-lg font-semibold text-gray-900 mt-1">
                                <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-700">
                                    {{ ucfirst($leaveRequest->type) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <p class="text-lg font-semibold text-gray-900 mt-1">
                                @if($leaveRequest->status === 'approved')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                        Approved
                                    </span>
                                @elseif($leaveRequest->status === 'rejected')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></path></svg>
                                        Rejected
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Start Date</p>
                            <p class="text-lg font-semibold text-gray-900 mt-1">{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">End Date</p>
                            <p class="text-lg font-semibold text-gray-900 mt-1">{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Number of Days</p>
                            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $leaveRequest->days_count }} day{{ $leaveRequest->days_count !== 1 ? 's' : '' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Reason -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Reason for Leave</h3>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $leaveRequest->reason ?? '—' }}</p>
                </div>

                <!-- Review Information -->
                @if($leaveRequest->status !== 'pending')
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Review Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600">Reviewed By</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $leaveRequest->reviewer?->name ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Reviewed At</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $leaveRequest->reviewed_at?->format('M d, Y H:i') ?? '—' }}</p>
                            </div>
                        </div>
                        @if($leaveRequest->manager_comment)
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">Manager Comment</p>
                                <p class="text-gray-700 bg-gray-50 p-4 rounded-lg mt-2">{{ $leaveRequest->manager_comment }}</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <a href="{{ route('hr.leaves.index') }}" class="mt-4 inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors duration-200">
            Back to Employees
        </a>
    </div>
</x-app-layout>