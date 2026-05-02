<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @php
        // Determine theme based on user role
        $roleThemes = [
            'admin' => [
                'primary' => 'bg-purple-700',
                'secondary' => 'bg-purple-800',
                'accent' => 'bg-purple-600',
                'hover' => 'hover:bg-purple-800',
                'active' => 'bg-purple-600',
                'light' => 'bg-purple-100',
                'text' => 'text-purple-900',
                'border' => 'border-purple-700',
                'badge' => 'bg-purple-100 text-purple-900',
            ],
            'hr' => [
                'primary' => 'bg-orange-700',
                'secondary' => 'bg-orange-800',
                'accent' => 'bg-orange-600',
                'hover' => 'hover:bg-orange-800',
                'active' => 'bg-orange-600',
                'light' => 'bg-orange-100',
                'text' => 'text-orange-900',
                'border' => 'border-orange-700',
                'badge' => 'bg-orange-100 text-orange-900',
            ],
            'manager' => [
                'primary' => 'bg-yellow-700',
                'secondary' => 'bg-yellow-800',
                'accent' => 'bg-yellow-600',
                'hover' => 'hover:bg-yellow-800',
                'active' => 'bg-yellow-600',
                'light' => 'bg-yellow-100',
                'text' => 'text-yellow-900',
                'border' => 'border-yellow-700',
                'badge' => 'bg-yellow-100 text-yellow-900',
            ],
            'employee' => [
                'primary' => 'bg-indigo-700',
                'secondary' => 'bg-indigo-800',
                'accent' => 'bg-indigo-600',
                'hover' => 'hover:bg-indigo-800',
                'active' => 'bg-indigo-600',
                'light' => 'bg-indigo-100',
                'text' => 'text-indigo-900',
                'border' => 'border-indigo-700',
                'badge' => 'bg-indigo-100 text-indigo-900',
            ],
        ];
        
        $userRole = auth()->user()->isAdmin() ? 'admin' : (auth()->user()->isHR() ? 'hr' : (auth()->user()->isManager() ? 'manager' : 'employee'));
        $theme = $roleThemes[$userRole] ?? $roleThemes['employee'];
    @endphp

    <div x-data="{ sidebarOpen: true }" class="min-h-screen flex {{ $theme['light'] }}">
        {{-- SIDEBAR --}}
        <aside :class="sidebarOpen ? 'w-64' : 'w-0'" class="transition-all duration-300 overflow-hidden min-h-screen {{ $theme['primary'] }} text-white flex flex-col fixed top-0 left-0 z-50">
            
            {{-- Logo Section --}}
            <div class="flex flex-col items-center justify-center px-6 py-6 {{ $theme['border'] }} border-b bg-black">
                <div class="relative mb-3">
                    <img src="{{ asset('images/employee.png') }}" alt="Logo" class="h-14 w-14 rounded-full shadow-lg border-4 border-white">
                    <div class="absolute bottom-0 right-0 h-5 w-5 rounded-full bg-green-400 border-2 border-white"></div>
                </div>
                <span class="text-white font-bold text-center text-lg tracking-wide">
                    Employee Management
                </span>
                <span class="text-xs mt-2 px-3 py-1 rounded-full {{ $theme['accent'] }} text-white font-semibold uppercase">
                    {{ ucfirst($userRole) }}
                </span>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
                
                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('dashboard') ? $theme['active'] : '' }}">
                    🏠
                    <span>Dashboard</span>
                </a>

                @if(auth()->user()->isAdmin())
                    {{-- Admin Navigation --}}

                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('admin.users.*') ? $theme['active'] : '' }}">
                        👥
                        <span>Manage Users</span>
                    </a>

                    <a href="{{ route('admin.departments.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('admin.departments.*') ? $theme['active'] : '' }}">
                       🏢
                        <span>Departments</span>
                    </a>

                    <a href="{{ route('admin.employees.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('admin.employees.*') ? $theme['active'] : '' }}">
                        👨‍💼
                        <span>All Employees</span>
                    </a>

                    <a href="{{ route('admin.logs.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('admin.logs.*') ? $theme['active'] : '' }}">
                        📋
                        <span>Activity Logs</span>
                    </a>

                @elseif(auth()->user()->isHR())
                    {{-- HR Navigation --}}

                    <a href="{{ route('hr.employees.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('hr.employees.*') ? $theme['active'] : '' }}">
                        📁
                        <span>Employee Records</span>
                    </a>

                    <a href="{{ route('hr.payslips.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('hr.payslips.*') ? $theme['active'] : '' }}">
                        💰
                        <span>Payroll / Payslips</span>
                    </a>

                    <a href="{{ route('hr.leaves.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('hr.leaves.*') ? $theme['active'] : '' }}">
                        📅
                        <span>Leave Requests</span>
                    </a>

                    <a href="{{ route('hr.attendance.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('hr.attendance.*') ? $theme['active'] : '' }}">
                        🕒
                        <span>Attendance</span>
                    </a>

                @elseif(auth()->user()->isManager())
                    {{-- Manager Navigation --}}

                    <a href="{{ route('manager.team.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('manager.team.*') ? $theme['active'] : '' }}">
                        👨‍👩‍👧‍👦
                        <span>My Team</span>
                    </a>

                    <a href="{{ route('manager.leaves.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('manager.leaves.*') ? $theme['active'] : '' }}">
                        ✅
                        <span>Leave Approvals</span>
                    </a>

                @else
                    {{-- Employee Navigation --}}

                    <a href="{{ route('employee.profile') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('employee.profile*') ? $theme['active'] : '' }}">
                        👤
                        <span>My Profile</span>
                    </a>

                    <a href="{{ route('employee.payslips.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('employee.payslips.*') ? $theme['active'] : '' }}">
                        💵
                        <span>My Payslips</span>
                    </a>

                    <a href="{{ route('employee.leaves.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('employee.leaves.*') ? $theme['active'] : '' }}">
                        📅
                        <span>Leave Requests</span>
                    </a>

                    <a href="{{ route('employee.attendance.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200 {{ request()->routeIs('employee.attendance.*') ? $theme['active'] : '' }}">
                        ⏰
                        <span>My Attendance</span>
                    </a>
                @endif
            </nav>

            {{-- User Profile Section --}}
            <div class="px-3 py-4 {{ $theme['border'] }} bg-black border-t space-y-3">
                <div class="flex items-center gap-3 px-4 py-3 rounded-lg {{ $theme['secondary'] }}">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full {{ $theme['accent'] }} text-white font-bold flex items-center justify-center">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-200">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-100 {{ $theme['hover'] }} transition duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="flex-1 transition-all duration-300 flex flex-col min-h-screen">
            {{-- Header --}}
            <header class="bg-white shadow-md px-8 py-5 flex items-center justify-between sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        @isset($header)
                            <h1 class="text-2xl font-bold {{ $theme['text'] }}">{{ $header }}</h1>
                        @else
                            <h1 class="text-2xl font-bold {{ $theme['text'] }}">Dashboard</h1>
                        @endisset
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ now()->format('M d, Y') }}</p>
                    </div>
                    <div class="h-10 w-10 rounded-full {{ $theme['accent'] }} text-white font-bold flex items-center justify-center">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="flex-1 p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>