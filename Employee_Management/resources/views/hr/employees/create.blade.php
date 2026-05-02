<x-app-layout>
<x-slot name="header">
    <div>
        <h2 class="text-3xl font-bold text-gray-900">Add Employee</h2>
        <p class="text-gray-600 text-sm mt-1">Create a new employee record and login account</p>
    </div>
</x-slot>

<div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <form method="POST" action="{{ route('hr.employees.store') }}" class="space-y-6">
        @csrf

        <!-- Personal Information -->
        <div class="bg-white rounded-lg shadow p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Personal Information</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">First Name <span class="text-red-500">*</span></label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="John"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('first_name') border-red-500 @enderror">
                    @error('first_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Doe"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('last_name') border-red-500 @enderror">
                    @error('last_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name') }}" placeholder="Robert"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Email (Login) <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('email') border-red-500 @enderror">
                    @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    <p class="text-gray-400 text-xs mt-1">Default password will be: <strong>password123</strong></p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Birthdate</label>
                    <input type="date" name="birthdate" value="{{ old('birthdate') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Gender</label>
                    <select name="gender" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        <option value="">— Select —</option>
                        <option value="male" @selected(old('gender') == 'male')>Male</option>
                        <option value="female" @selected(old('gender') == 'female')>Female</option>
                        <option value="other" @selected(old('gender') == 'other')>Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Civil Status</label>
                    <select name="civil_status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        <option value="">— Select —</option>
                        <option value="single" @selected(old('civil_status') == 'single')>Single</option>
                        <option value="married" @selected(old('civil_status') == 'married')>Married</option>
                        <option value="widowed" @selected(old('civil_status') == 'widowed')>Widowed</option>
                        <option value="separated" @selected(old('civil_status') == 'separated')>Separated</option>
                        <option value="divorced" @selected(old('civil_status') == 'divorced')>Divorced</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+63 9XX XXXX XXX"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Address</label>
                <textarea name="address" rows="3" placeholder="Street address, city, province"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ old('address') }}</textarea>
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
            <!-- Department -->
            <div>
                <label for="department_id" class="block text-sm font-semibold text-gray-900 mb-2">
                    Department <span class="text-red-500">*</span>
                </label>
                <select id="department_id" name="department_id"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('department_id') border-red-500 @enderror"
                    onchange="filterPositions()">
                    <option value="">— Select Department —</option>
                        @foreach($departments as $d)
                        <option value="{{ $d->id }}" data-name="{{ strtolower($d->name) }}"
                            @selected(old('department_id') == $d->id)>
                            {{ $d->name }}
                        </option>
                        @endforeach
                </select>
                    @error('department_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Position -->
            <div>
                <label for="position" class="block text-sm font-semibold text-gray-900 mb-2">
                    Position <span class="text-red-500">*</span>
                </label>

                <select id="position" name="position"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('position') border-red-500 @enderror">
                        <option value="">— Select Department First —</option>

                        {{-- IT / Software --}}
                        <option value="Software Engineer" data-dept="it" class="dept-option hidden">Software Engineer</option>
                        <option value="IT Support" data-dept="it" class="dept-option hidden">IT Support</option>
                        <option value="Business Analyst" data-dept="it" class="dept-option hidden">Business Analyst</option>
                        <option value="System Administrator" data-dept="it" class="dept-option hidden">System Administrator</option>

                        {{-- HR --}}
                        <option value="HR Officer" data-dept="hr" class="dept-option hidden">HR Officer</option>
                        <option value="HR Assistant" data-dept="hr" class="dept-option hidden">HR Assistant</option>
                        <option value="Recruitment Specialist" data-dept="hr" class="dept-option hidden">Recruitment Specialist</option>

                        {{-- Finance / Accounting --}}
                        <option value="Accountant" data-dept="finance" class="dept-option hidden">Accountant</option>
                        <option value="Finance Officer" data-dept="finance" class="dept-option hidden">Finance Officer</option>
                        <option value="Payroll Specialist" data-dept="finance" class="dept-option hidden">Payroll Specialist</option>
                        <option value="Auditor" data-dept="finance" class="dept-option hidden">Auditor</option>

                        {{-- Operations / Management --}}
                        <option value="Operations Manager" data-dept="operations" class="dept-option hidden">Operations Manager</option>
                        <option value="Team Leader" data-dept="operations" class="dept-option hidden">Team Leader</option>
                        <option value="Project Manager" data-dept="operations" class="dept-option hidden">Project Manager</option>
                        <option value="Administrative Assistant" data-dept="operations" class="dept-option hidden">Administrative Assistant</option>

                        {{-- Sales / Marketing --}}
                        <option value="Sales Associate" data-dept="sales" class="dept-option hidden">Sales Associate</option>
                        <option value="Marketing Specialist" data-dept="sales" class="dept-option hidden">Marketing Specialist</option>
                        <option value="Account Manager" data-dept="sales" class="dept-option hidden">Account Manager</option>

                        {{-- Customer Service --}}
                        <option value="Customer Service Representative" data-dept="customer" class="dept-option hidden">Customer Service Representative</option>
                        <option value="Support Specialist" data-dept="customer" class="dept-option hidden">Support Specialist</option>

                        {{-- General --}}
                        <option value="Intern" data-dept="general" class="dept-option hidden">Intern</option>
                        <option value="Supervisor" data-dept="general" class="dept-option hidden">Supervisor</option>
                </select>
                @error('position')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Manager</label>
                    <select name="manager_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        <option value="">— None —</option>
                        @foreach($managers as $m)
                            <option value="{{ $m->id }}" @selected(old('manager_id') == $m->id)>{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Date Hired <span class="text-red-500">*</span></label>
                    <input type="date" name="date_hired" value="{{ old('date_hired') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('date_hired') border-red-500 @enderror">
                    @error('date_hired')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Employment Type</label>
                    <select name="employment_type" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        <option value="regular" @selected(old('employment_type') == 'regular')>Regular</option>
                        <option value="contractual" @selected(old('employment_type') == 'contractual')>Contractual</option>
                        <option value="probationary" @selected(old('employment_type') == 'probationary')>Probationary</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Basic Salary (₱) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="basic_salary" value="{{ old('basic_salary') }}" placeholder="0.00"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition @error('basic_salary') border-red-500 @enderror">
                    @error('basic_salary')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
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
                    'sss_number' => 'SSS Number',
                    'philhealth_number' => 'PhilHealth Number',
                    'pagibig_number' => 'Pag-IBIG Number',
                    'tin_number' => 'TIN Number',
                    'bank_account' => 'Bank Account'
                ] as $f => $l)
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">{{ $l }}</label>
                        <input type="text" name="{{ $f }}" value="{{ old($f) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3">
            <button type="submit"
                class="px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition flex items-center gap-2">
                Add Employee
            </button>
            <a href="{{ route('hr.employees.index') }}"
                class="px-6 py-2.5 border border-gray-400 bg-gray-300 hover:bg-gray-400 text-black font-medium rounded-lg transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    const deptMap = {
        'it':         ['it', 'information technology', 'software', 'tech', 'technology', 'systems'],
        'hr':         ['hr', 'human resource', 'human resources', 'personnel'],
        'finance':    ['finance', 'accounting', 'financial', 'accounts'],
        'operations': ['operations', 'admin', 'administration', 'management'],
        'sales':      ['sales', 'marketing', 'business development'],
        'customer':   ['customer', 'service', 'support'],
        'general':    [],
    };

    function filterPositions() {
        const deptSelect = document.getElementById('department_id');
        const positionSelect = document.getElementById('position');
        const selectedOption = deptSelect.options[deptSelect.selectedIndex];
        const deptName = selectedOption ? selectedOption.getAttribute('data-name') : '';

        // Reset position
        positionSelect.value = '';
        positionSelect.options[0].text = '— Select Position —';

        // Finds which dept group matches
        let matchedGroup = null;
        for (const [group, keywords] of Object.entries(deptMap)) {
            if (keywords.some(keyword => deptName.includes(keyword))) {
                matchedGroup = group;
                break;
            }
        }

        // Show/hide options
        const allOptions = positionSelect.querySelectorAll('.dept-option');
        allOptions.forEach(opt => {
            const optDept = opt.getAttribute('data-dept');

            if (!deptName) {
                //If No department selected — hide all
                opt.classList.add('hidden');
                opt.disabled = true;
            } else if (optDept === 'general' || optDept === matchedGroup) {
                // Show matching + general options
                opt.classList.remove('hidden');
                opt.disabled = false;
            } else {
                // Hide non-matching
                opt.classList.add('hidden');
                opt.disabled = true;
            }
        });
    }

    // Run on page load for old() values
    document.addEventListener('DOMContentLoaded', function () {
        const dept = document.getElementById('department_id');
        if (dept.value) {
            filterPositions();

            // Restore selected position after filtering
            const oldPosition = "{{ old('position') }}";
            if (oldPosition) {
                document.getElementById('position').value = oldPosition;
            }
        }
    });
</script>
</x-app-layout>