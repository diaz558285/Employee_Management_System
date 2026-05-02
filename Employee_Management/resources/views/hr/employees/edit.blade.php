<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Edit Employee</h2>
            <p class="text-gray-600 text-sm mt-1">{{ $employee->full_name }}</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('hr.employees.update', $employee) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Personal Information</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">First Name</label>
                        <input 
                            type="text"
                            name="first_name" 
                            value="{{ old('first_name', $employee->first_name) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Last Name</label>
                        <input 
                            type="text"
                            name="last_name" 
                            value="{{ old('last_name', $employee->last_name) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Middle Name</label>
                        <input 
                            type="text"
                            name="middle_name" 
                            value="{{ old('middle_name', $employee->middle_name) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Phone</label>
                        <input 
                            type="tel"
                            name="phone" 
                            value="{{ old('phone', $employee->phone) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>
                      <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Civil Status</label>
                        <select
                            name="civil_status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                            <option value="">--- Select ---</option>
                            <option value="single" @selected(old('civil_status', $employee->civil_status) == 'single')>Single</option>
                            <option value="married" @selected(old('civil_status', $employee->civil_status) == 'married')>Married</option>
                            <option value="widowed" @selected(old('civil_status', $employee->civil_status) == 'widowed')>Widowed</option>
                            <option value="separated" @selected(old('civil_status', $employee->civil_status) == 'separated')>Separated</option>
                            <option value="divorced" @selected(old('civil_status', $employee->civil_status) == 'divorced')>Divorced</option>
                        </select>
                    </div>
                </div>

                <!-- Address -->
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Address</label>
                    <textarea 
                        name="address" 
                        rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"
                    >{{ old('address', $employee->address) }}</textarea>
                </div>
            </div>

            <!-- Employment Details -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4m0 0L14 6m2-2l2 2M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Employment Details</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Position</label>
                        <select
                            name="position"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                            <option value="">— Select Position —</option>
                            <option value="Software Engineer" @selected(old('position', $employee->position) == 'Software Engineer')>Software Engineer</option>
                            <option value="HR Officer" @selected(old('position', $employee->position) == 'HR Officer')>HR Officer</option>
                            <option value="Accountant" @selected(old('position', $employee->position) == 'Accountant')>Accountant</option>
                            <option value="Team Leader" @selected(old('position', $employee->position) == 'Team Leader')>Team Leader</option>
                            <option value="Project Manager" @selected(old('position', $employee->position) == 'Project Manager')>Project Manager</option>
                            <option value="Sales Associate" @selected(old('position', $employee->position) == 'Sales Associate')>Sales Associate</option>
                            <option value="Marketing Specialist" @selected(old('position', $employee->position) == 'Marketing Specialist')>Marketing Specialist</option>
                            <option value="IT Support" @selected(old('position', $employee->position) == 'IT Support')>IT Support</option>
                            <option value="Finance Officer" @selected(old('position', $employee->position) == 'Finance Officer')>Finance Officer</option>
                            <option value="Administrative Assistant" @selected(old('position', $employee->position) == 'Administrative Assistant')>Administrative Assistant</option>
                            <option value="Operations Manager" @selected(old('position', $employee->position) == 'Operations Manager')>Operations Manager</option>
                            <option value="Business Analyst" @selected(old('position', $employee->position) == 'Business Analyst')>Business Analyst</option>
                            <option value="Customer Service Representative" @selected(old('position', $employee->position) == 'Customer Service Representative')>Customer Service Representative</option>
                            <option value="Intern" @selected(old('position', $employee->position) == 'Intern')>Intern</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Department</label>
                        <select 
                            name="department_id" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                            @foreach($departments as $d)
                                <option value="{{ $d->id }}" @selected($employee->department_id == $d->id)>{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Manager</label>
                        <select 
                            name="manager_id" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                            <option value="">— None —</option>
                            @foreach($managers as $m)
                                <option value="{{ $m->id }}" @selected($employee->manager_id == $m->id)>{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Basic Salary (₱)</label>
                        <input 
                            type="number"
                            step="0.01"
                            name="basic_salary" 
                            value="{{ old('basic_salary', $employee->basic_salary) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Employment Type</label>
                        <select 
                            name="employment_type" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                            <option value="regular" @selected($employee->employment_type == 'regular')>Regular</option>
                            <option value="contractual" @selected($employee->employment_type == 'contractual')>Contractual</option>
                            <option value="probationary" @selected($employee->employment_type == 'probationary')>Probationary</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                        <select 
                            name="status" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        >
                            <option value="active" @selected($employee->status == 'active')>Active</option>
                            <option value="inactive" @selected($employee->status == 'inactive')>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Government IDs -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v10a2 2 0 002 2h5m0 0h5a2 2 0 002-2v-10a2 2 0 00-2-2h-5m0 0V5a2 2 0 012-2h5a2 2 0 012 2v2"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Government IDs</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach([
                        'sss_number' => 'SSS',
                        'philhealth_number' => 'PhilHealth',
                        'pagibig_number' => 'Pag-IBIG',
                        'tin_number' => 'TIN',
                        'bank_account' => 'Bank Account'
                    ] as $f => $l)
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">{{ $l }}</label>
                            <input 
                                type="text"
                                name="{{ $f }}" 
                                value="{{ old($f, $employee->$f) }}" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                    Update Employee
                </button>
                <a href="{{ route('hr.employees.index') }}" class="px-6 py-2.5 border border-gray-400 bg-gray-300 hover:bg-gray-400 text-black font-medium rounded-lg transition-colors duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>