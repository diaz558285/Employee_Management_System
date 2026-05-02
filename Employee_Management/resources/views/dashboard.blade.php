<x-app-layout>
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Dashboard</h2>
            <p class="text-gray-600 text-sm mt-1">Welcome back, <em>{{ auth()->user()->name }}!</em></p>
        </div>
    </x-slot>

    @php $user = auth()->user(); @endphp

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ADMIN DASHBOARD --}}
        @if($user->isAdmin())
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Users</p>
                                <p class="text-4xl font-bold text-gray-900 mt-2">{{ \App\Models\User::count() }}</p>
                                <p class="text-gray-500 text-xs mt-2">All registered accounts</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-2xl">
                                👥
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Departments -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Departments</p>
                                <p class="text-4xl font-bold text-gray-900 mt-2">{{ \App\Models\Department::count() }}</p>
                                <p class="text-gray-500 text-xs mt-2">Active departments</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-2xl">
                                🏢
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Employees -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Employees</p>
                                <p class="text-4xl font-bold text-gray-900 mt-2">{{ \App\Models\Employee::count() }}</p>
                                <p class="text-gray-500 text-xs mt-2">All employees</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center text-2xl">
                                👨‍💼
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users Table -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
                        <p class="text-sm text-gray-600 mt-1">Last 5 registered accounts</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="text-purple-600 hover:text-purple-800 font-medium text-md">View all →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-purple-300 border-b border-gray-200 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(\App\Models\User::latest()->take(5)->get() as $u)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-sm font-semibold text-blue-700">
                                                {{ substr($u->name, 0, 1) }}
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $u->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $u->email }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium
                                            @if($u->role === 'admin') bg-purple-100 text-purple-700
                                            @elseif($u->role === 'hr') bg-orange-100 text-orange-700
                                            @elseif($u->role === 'manager') bg-yellow-100 text-yellow-700
                                            @else bg-indigo-100 text-indigo-700
                                            @endif">
                                            {{ ucfirst($u->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($u->is_active)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                                ✓ Active
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        {{-- HR DASHBOARD --}}
        @elseif($user->isHR())
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <!-- Total Employees -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Employees</p>
                                <p class="text-4xl font-bold text-gray-900 mt-2">{{ \App\Models\Employee::count() }}</p>
                                <p class="text-gray-500 text-xs mt-2">Across all departments</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-2xl">
                                📁
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Leaves -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Pending Leaves</p>
                                <p class="text-4xl font-bold text-yellow-500 mt-2">{{ \App\Models\LeaveRequest::where('status','pending')->count() }}</p>
                                <p class="text-gray-500 text-xs mt-2">Awaiting approval</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-2xl">
                                📅
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Employees -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Active Employees</p>
                                <p class="text-4xl font-bold text-emerald-600 mt-2">{{ \App\Models\Employee::where('status','active')->count() }}</p>
                                <p class="text-gray-500 text-xs mt-2">Currently working</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center text-2xl">
                                ✅
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Leave Requests -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Recent Leave Requests</h3>
                        <p class="text-sm text-gray-600 mt-1">Latest 5 requests</p>
                    </div>
                    <a href="{{ route('hr.leaves.index') }}" class="text-orange-600 hover:text-orange-700 font-medium text-md">View all →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-orange-300 border-b border-gray-200 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Dates</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(\App\Models\LeaveRequest::with('employee')->latest()->take(5)->get() as $leave)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-sm font-semibold text-blue-700">
                                                {{ substr($leave->employee?->full_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $leave->employee?->full_name }}</p>
                                                <p class="text-xs text-gray-500">{{ $leave->employee?->position }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                            {{ ucfirst($leave->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }} → {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
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
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        {{-- MANAGER DASHBOARD --}}
        @elseif($user->isManager())
            @php
                $teamCount = \App\Models\Employee::where('manager_id', $user->id)->count();
                $pendingLeaves = \App\Models\LeaveRequest::whereHas('employee', fn($q) => $q->where('manager_id', $user->id))->where('status','pending')->count();
                $activeTeamMembers = \App\Models\Employee::where('manager_id', $user->id)->where('status', 'active')->count();
            @endphp

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <!-- Team Members -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Team Members</p>
                                <p class="text-4xl font-bold text-gray-900 mt-2">{{ $teamCount }}</p>
                                <p class="text-gray-500 text-xs mt-2">{{ $activeTeamMembers }} active</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-2xl">
                                👨‍👩‍👧‍👦
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Leave Approvals -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Pending Approvals</p>
                                <p class="text-4xl font-bold text-yellow-500 mt-2">{{ $pendingLeaves }}</p>
                                <p class="text-gray-500 text-xs mt-2">Leave requests</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-2xl">
                                ✅
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Action -->
                <div class="bg-gradient-to-br from-yellow-600 to-yellow-700 rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Team Management</p>
                                <p class="text-white text-lg font-semibold mt-2">View Team</p>
                                <p class="text-blue-100 text-xs mt-2">Manage your team members</p>
                            </div>
                            <a href="{{ route('manager.team.index') }}" class="w-12 h-12 bg-yellow-500 hover:bg-yellow-800 rounded-lg flex items-center justify-center transition-colors duration-200 text-2xl">
                                →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Team -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">My Team</h3>
                        <p class="text-sm text-gray-600 mt-1">Latest 5 team members</p>
                    </div>
                    <a href="{{ route('manager.team.index') }}" class="text-yellow-600 hover:text-yellow-700 font-medium text-md">View all →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-yellow-300 border-b border-gray-200 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Position</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(\App\Models\Employee::with('department')->where('manager_id', $user->id)->take(5)->get() as $emp)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-sm font-semibold text-blue-700">
                                                {{ substr($emp->full_name, 0, 1) }}
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $emp->full_name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $emp->position }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                            {{ $emp->department?->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($emp->status === 'active')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                                ✓ Active
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        {{-- EMPLOYEE DASHBOARD --}}
        @else
            @php $employee = $user->employee; @endphp

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <!-- My Position -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Position</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $employee?->position ?? '—' }}</p>
                                <p class="text-gray-500 text-xs mt-2">Your current role</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-2xl">
                                👤
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Department -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Department</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $employee?->department?->name ?? '—' }}</p>
                                <p class="text-gray-500 text-xs mt-2">Your department</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-2xl">
                                🏢
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Leave Requests -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Leave Requests</p>
                                <p class="text-4xl font-bold text-gray-900 mt-2">{{ $employee?->leaveRequests()->count() ?? 0 }}</p>
                                <p class="text-gray-500 text-xs mt-2">Total submitted</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center text-2xl">
                                📅
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Leave Requests -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">My Recent Leave Requests</h3>
                        <p class="text-sm text-gray-600 mt-1">Latest 5 requests</p>
                    </div>
                    <a href="{{ route('employee.leaves.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium text-md">View all →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-indigo-300 border-b border-gray-200 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Dates</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Days</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($employee?->leaveRequests()->latest()->take(5)->get() ?? [] as $leave)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                            {{ ucfirst($leave->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }} → {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $leave->days_count }} day{{ $leave->days_count !== 1 ? 's' : '' }}</td>
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
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <span class="text-5xl">📋</span>
                                            <p class="text-gray-500 font-medium">No leave requests yet</p>
                                            <a href="{{ route('employee.leaves.create') }}" class="text-blue-600 hover:underline text-sm mt-2">Request leave →</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>