<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/employee.png') }}" alt="Logo" class="h-8 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex items-center">
                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Users
                        </x-nav-link>
                        <x-nav-link :href="route('admin.departments.index')" :active="request()->routeIs('admin.departments.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Departments
                        </x-nav-link>
                        <x-nav-link :href="route('admin.employees.index')" :active="request()->routeIs('admin.employees.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Employees
                        </x-nav-link>
                        <x-nav-link :href="route('admin.logs.index')" :active="request()->routeIs('admin.logs.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Activity Logs
                        </x-nav-link>

                    @elseif(auth()->user()->isHR())
                        <x-nav-link :href="route('hr.employees.index')" :active="request()->routeIs('hr.employees.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Employees
                        </x-nav-link>
                        <x-nav-link :href="route('hr.payslips.index')" :active="request()->routeIs('hr.payslips.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Payslips
                        </x-nav-link>
                        <x-nav-link :href="route('hr.leaves.index')" :active="request()->routeIs('hr.leaves.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Leave Requests
                        </x-nav-link>
                        <x-nav-link :href="route('hr.attendance.index')" :active="request()->routeIs('hr.attendance.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Attendance
                        </x-nav-link>
                        

                    @elseif(auth()->user()->isManager())
                        <x-nav-link :href="route('manager.team.index')" :active="request()->routeIs('manager.team.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            My Team
                        </x-nav-link>
                        <x-nav-link :href="route('manager.leaves.index')" :active="request()->routeIs('manager.leaves.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Leave Approvals
                        </x-nav-link>

                    @else
                        <x-nav-link :href="route('employee.profile')" :active="request()->routeIs('employee.profile*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            My Profile
                        </x-nav-link>
                        <x-nav-link :href="route('employee.payslips.index')" :active="request()->routeIs('employee.payslips.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            My Payslips
                        </x-nav-link>
                        <x-nav-link :href="route('employee.leaves.index')" :active="request()->routeIs('employee.leaves.*')"
                            class="text-gray-300 hover:text-white hover:bg-gray-700 rounded px-3 py-2">
                            Leave Requests
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side: User info + Logout Button -->
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <!-- Logged in user name + role -->
                <div class="text-right">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ ucfirst(Auth::user()->role) }}</p>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded transition duration-150">
                        Sign Out
                    </button>
                </form>
            </div>

            <!-- Hamburger (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-800">
        <div class="pt-2 pb-3 space-y-1 px-2">
            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    Users
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.departments.index')" :active="request()->routeIs('admin.departments.*')">
                    Departments
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.employees.index')" :active="request()->routeIs('admin.employees.*')">
                    Employees
                </x-responsive-nav-link>
                  <x-responsive-nav-link :href="route('admin.logs.index')" :active="request()->routeIs('admin.logs.*')">
                    Activity Logs
                </x-responsive-nav-link>

            @elseif(auth()->user()->isHR())
                <x-responsive-nav-link :href="route('hr.employees.index')" :active="request()->routeIs('hr.employees.*')">
                    Employees
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('hr.payslips.index')" :active="request()->routeIs('hr.payslips.*')">
                    Payslips
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('hr.leaves.index')" :active="request()->routeIs('hr.leaves.*')">
                    Leave Requests
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('hr.attendance.index')" :active="request()->routeIs('hr.attendance.*')">
                    Attendance
                </x-responsive-nav-link>

            @elseif(auth()->user()->isManager())
                <x-responsive-nav-link :href="route('manager.team.index')" :active="request()->routeIs('manager.team.*')">
                    My Team
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('manager.leaves.index')" :active="request()->routeIs('manager.leaves.*')">
                    Leave Approvals
                </x-responsive-nav-link>

            @else
                <x-responsive-nav-link :href="route('employee.profile')" :active="request()->routeIs('employee.profile*')">
                    My Profile
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('employee.payslips.index')" :active="request()->routeIs('employee.payslips.*')">
                    My Payslips
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('employee.leaves.index')" :active="request()->routeIs('employee.leaves.*')">
                    Leave Requests
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile logout -->
        <div class="pt-4 pb-3 border-t border-gray-700 px-4">
            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-400 mb-3">{{ ucfirst(Auth::user()->role) }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded transition duration-150">
                    Sign Out
                </button>
            </form>
        </div>
    </div>
</nav>