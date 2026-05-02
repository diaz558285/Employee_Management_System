<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Edit Payslip</h2>
            <p class="text-gray-600 text-sm mt-1">{{ $payslip->employee->full_name }} — {{ $payslip->period_label }}</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('hr.payslips.update', $payslip) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Period Information -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Pay Period</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Period Label
                        </label>
                        <input 
                            type="text"
                            name="period_label" 
                            value="{{ old('period_label', $payslip->period_label) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Pay Date
                        </label>
                        <input 
                            type="date"
                            name="pay_date" 
                            value="{{ old('pay_date', $payslip->pay_date) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>
                </div>
            </div>

            <!-- Earnings Section -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Earnings</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach([
                        'basic_salary' => 'Basic Salary (₱)',
                        'overtime_pay' => 'Overtime Pay (₱)',
                        'allowances' => 'Allowances (₱)'
                    ] as $f => $l)
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                {{ $l }}
                            </label>
                            <input 
                                type="number"
                                step="0.01"
                                name="{{ $f }}" 
                                value="{{ old($f, $payslip->$f) }}" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Deductions Section -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m0 0L4 7m8 4v10m0 0l8-4m-8 4l-8-4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Deductions</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach([
                        'sss' => 'SSS (₱)',
                        'philhealth' => 'PhilHealth (₱)',
                        'pagibig' => 'Pag-IBIG (₱)',
                        'withholding_tax' => 'Withholding Tax (₱)',
                        'other_deductions' => 'Other Deductions (₱)'
                    ] as $f => $l)
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                {{ $l }}
                            </label>
                            <input 
                                type="number"
                                step="0.01"
                                name="{{ $f }}" 
                                value="{{ old($f, $payslip->$f) }}" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Notes Section -->
            <div class="bg-white rounded-lg shadow p-8">
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    Notes
                </label>
                <textarea 
                    name="notes" 
                    rows="4"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"
                >{{ old('notes', $payslip->notes) }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                    Update Payslip
                </button>
                <a href="{{ route('hr.payslips.index') }}" class="px-6 py-2.5 border border-gray-300 bg-gray-300 hover:bg-gray-400 text-black font-medium rounded-lg transition-colors duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>