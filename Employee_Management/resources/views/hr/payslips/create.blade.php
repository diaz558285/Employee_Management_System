<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Generate Payslip</h2>
            <p class="text-gray-600 text-sm mt-1">Create a new payslip for an employee</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('hr.payslips.store') }}" class="space-y-6">
            @csrf

            <!-- Employee Selection -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Employee Information</h3>
                </div>

                <div>
                    <label for="employee_id" class="block text-sm font-semibold text-gray-900 mb-2">
                        Employee
                        <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="employee_id"
                        name="employee_id" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition @error('employee_id') border-red-500 @enderror">
                        <option value="">--- Select Employee ---</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" @selected(old('employee_id') == $emp->id)>
                                {{ $emp->full_name }} ({{ $emp->employee_number }})
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

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
                        <label for="period_label" class="block text-sm font-semibold text-gray-900 mb-2">
                            Period Label
                        </label>
                        <input 
                            type="text"
                            id="period_label"
                            name="period_label" 
                            value="{{ old('period_label') }}" 
                            placeholder="e.g. May 2026 - 1st Half"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>

                    <div>
                        <label for="pay_date" class="block text-sm font-semibold text-gray-900 mb-2">
                            Pay Date
                        </label>
                        <input 
                            type="date"
                            id="pay_date"
                            name="pay_date" 
                            value="{{ old('pay_date') }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>

                    <div>
                        <label for="period_start" class="block text-sm font-semibold text-gray-900 mb-2">
                            Period Start Date
                        </label>
                        <input 
                            type="date"
                            id="period_start"
                            name="period_start" 
                            value="{{ old('period_start') }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>

                    <div>
                        <label for="period_end" class="block text-sm font-semibold text-gray-900 mb-2">
                            Period End Date
                        </label>
                        <input 
                            type="date"
                            id="period_end"
                            name="period_end" 
                            value="{{ old('period_end') }}" 
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
                    <div>
                        <label for="basic_salary" class="block text-sm font-semibold text-gray-900 mb-2">
                            Basic Salary (₱)
                        </label>
                        <input 
                            type="number"
                            id="basic_salary"
                            step="0.01"
                            name="basic_salary" 
                            value="{{ old('basic_salary', 0) }}" 
                            placeholder="0.00"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>

                    <div>
                        <label for="overtime_pay" class="block text-sm font-semibold text-gray-900 mb-2">
                            Overtime Pay (₱)
                        </label>
                        <input 
                            type="number"
                            id="overtime_pay"
                            step="0.01"
                            name="overtime_pay" 
                            value="{{ old('overtime_pay', 0) }}" 
                            placeholder="0.00"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>

                    <div>
                        <label for="allowances" class="block text-sm font-semibold text-gray-900 mb-2">
                            Allowances (₱)
                        </label>
                        <input 
                            type="number"
                            id="allowances"
                            step="0.01"
                            name="allowances" 
                            value="{{ old('allowances', 0) }}" 
                            placeholder="0.00"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>
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
                            <label for="{{ $f }}" class="block text-sm font-semibold text-gray-900 mb-2">
                                {{ $l }}
                            </label>
                            <input 
                                type="number"
                                id="{{ $f }}"
                                step="0.01"
                                name="{{ $f }}" 
                                value="{{ old($f, 0) }}" 
                                placeholder="0.00"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Notes Section -->
            <div class="bg-white rounded-lg shadow p-8">
                <label for="notes" class="block text-sm font-semibold text-gray-900 mb-2">
                    Notes
                </label>
                <textarea 
                    id="notes"
                    name="notes" 
                    rows="4"
                    placeholder="Add any additional notes..."
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"
                >{{ old('notes') }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Generate Payslip
                </button>
                <a href="{{ route('hr.payslips.index') }}" class="px-6 py-2.5 border border-gray-400 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>