<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Payslip</h2>
            <p class="text-gray-600 text-sm mt-1">{{ $payslip->period_label }}</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Payslip Document -->
        <div class="bg-white rounded-lg shadow overflow-hidden" id="payslip-print">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-8 py-8 text-white">
                <div class="text-center">
                    <h1 class="text-3xl font-bold">PAYSLIP</h1>
                    <p class="text-orange-100 mt-2">{{ $payslip->period_label }}</p>
                </div>
            </div>

            <!-- Employee Information -->
            <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-500 mb-1">Employee Name</p>
                        <p class="text-lg font-bold text-gray-900">{{ $payslip->employee->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-500 mb-1">Employee Number</p>
                        <p class="text-lg font-bold text-gray-900">{{ $payslip->employee->employee_number }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-500 mb-1">Position</p>
                        <p class="text-lg font-bold text-gray-900">{{ $payslip->employee->position }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-500 mb-1">Department</p>
                        <p class="text-lg font-bold text-gray-900">{{ $payslip->employee->department?->name ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-500 mb-1">Period</p>
                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($payslip->period_start)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($payslip->period_end)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-500 mb-1">Pay Date</p>
                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($payslip->pay_date)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-8 py-8 space-y-6">
                <!-- Earnings Section -->
                <div>
                    <h3 class="text-sm font-bold uppercase text-gray-700 mb-4 pb-2 border-b-2 border-emerald-500">Earnings</h3>
                    <table class="w-full">
                        <tbody class="space-y-2">
                            @php
                                $earnings = [
                                    'basic_salary' => 'Basic Salary',
                                    'overtime_pay' => 'Overtime Pay',
                                    'allowances' => 'Allowances'
                                ];
                            @endphp
                            @foreach($earnings as $field => $label)
                                <tr class="border-b border-gray-200">
                                    <td class="py-3 text-gray-600">{{ $label }}</td>
                                    <td class="py-3 text-right font-semibold text-gray-900">₱ {{ number_format($payslip->$field, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-emerald-50 font-bold">
                                <td class="py-3 text-gray-900">Gross Pay</td>
                                <td class="py-3 text-right text-emerald-600">₱ {{ number_format($payslip->gross_pay, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Deductions Section -->
                <div>
                    <h3 class="text-sm font-bold uppercase text-gray-700 mb-4 pb-2 border-b-2 border-red-500">Deductions</h3>
                    <table class="w-full">
                        <tbody class="space-y-2">
                            @php
                                $deductions = [
                                    'sss' => 'SSS',
                                    'philhealth' => 'PhilHealth',
                                    'pagibig' => 'Pag-IBIG',
                                    'withholding_tax' => 'Withholding Tax',
                                    'other_deductions' => 'Other Deductions'
                                ];
                            @endphp
                            @foreach($deductions as $field => $label)
                                <tr class="border-b border-gray-200">
                                    <td class="py-3 text-gray-600">{{ $label }}</td>
                                    <td class="py-3 text-right font-semibold text-gray-900">₱ {{ number_format($payslip->$field, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-red-50 font-bold">
                                <td class="py-3 text-gray-900">Total Deductions</td>
                                <td class="py-3 text-right text-red-600">₱ {{ number_format($payslip->total_deductions, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Net Pay Summary -->
                <div class="bg-gradient-to-r from-orange-600 to-orange-700 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-semibold uppercase">Net Pay</p>
                            <p class="text-3xl font-bold">₱ {{ number_format($payslip->net_pay, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-orange-100 text-sm">Gross: ₱ {{ number_format($payslip->gross_pay, 2) }}</p>
                            <p class="text-orange-100 text-sm">Deductions: ₱ {{ number_format($payslip->total_deductions, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                @if($payslip->notes)
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <p class="text-xs font-semibold uppercase text-amber-700 mb-2">Notes</p>
                        <p class="text-sm text-amber-900">{{ $payslip->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 text-center text-xs text-gray-500">
                <p>This is an automatically generated payslip. For inquiries, please contact the HR department.</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex gap-3">
            <button 
                onclick="window.print()" 
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-lg transition-colors duration-200"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 0h6a2 2 0 002-2m-6 2a2 2 0 01-2-2m0 0V9m6 0v4a2 2 0 01-2 2m-6-2a2 2 0 01-2-2V9m12-3H9m0 0a1 1 0 000 2h6a1 1 0 100-2H9z"/>
                </svg>
                Print Payslip
            </button>
            <a href="{{ route('hr.payslips.edit', $payslip) }}" class="inline-flex items-center gap-2 px-6 py-2.5 border border-gray-400 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                Edit
            </a>
            <a href="{{ route('hr.payslips.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 border border-gray-400 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                Back to Payslips
            </a>
        </div>
    </div>

    <!-- Print Styles -->
    <style media="print">
        body {
            background: white;
        }
        .no-print {
            display: none;
        }
        #payslip-print {
            box-shadow: none;
        }
    </style>
</x-app-layout>