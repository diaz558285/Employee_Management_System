<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">My Payslips</h2>
            <p class="text-gray-600 text-sm mt-1">View your salary statements and payment history</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Stats -->
        <div class="mb-6">
            <p class="text-sm text-gray-600">
                Showing <span class="font-semibold text-gray-900">{{ $payslips->count() }}</span> of <span class="font-semibold text-gray-900">{{ $payslips->total() }}</span> payslips
            </p>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-indigo-300 border-b border-gray-200 text-black">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Period</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Pay Date</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider">Gross Pay</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider">Deductions</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider">Net Pay</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($payslips as $p)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                        {{ $p->period_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($p->pay_date)->format('M d, Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <div>
                                        <p class="font-semibold text-gray-900">₱ {{ number_format($p->gross_pay, 2) }}</p>
                                        <p class="text-xs text-gray-500">Gross</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <div>
                                        <p class="font-semibold text-gray-900">₱ {{ number_format($p->total_deductions, 2) }}</p>
                                        <p class="text-xs text-gray-500">Deductions</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <div>
                                        <p class="font-bold text-emerald-600">₱ {{ number_format($p->net_pay, 2) }}</p>
                                        <p class="text-xs text-gray-500">Net</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('employee.payslips.show', $p) }}" class="text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-gray-500 font-medium">No payslips available yet</p>
                                        <p class="text-gray-500 text-sm">Your payslips will appear here once they are generated by HR</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($payslips->hasPages())
            <div class="mt-6">
                {{ $payslips->links() }}
            </div>
        @endif
    </div>
</x-app-layout>