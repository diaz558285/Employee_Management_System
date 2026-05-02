<x-app-layout>
<x-slot name="header">
    <div>
        <h2 class="text-3xl font-bold text-gray-900">My Attendance</h2>
        <p class="text-gray-600 text-sm mt-1">Your attendance history</p>
    </div>
</x-slot>
<div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

    <form method="GET" class="flex gap-2 mb-6 col-span-3">
        <select name="month" class=" w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">All Months</option>
            @foreach(range(1,12) as $m)
                <option value="{{ $m }}" @selected(request('month') == $m)>{{ date('F', mktime(0,0,0,$m,1)) }}</option>
            @endforeach
        </select>
        <select name="year" class=" w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">All Years</option>
            @foreach(range(date('Y'), date('Y')-3) as $y)
                <option value="{{ $y }}" @selected(request('year') == $y)>{{ $y }}</option>
            @endforeach
        </select>
        <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
    </form>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-indigo-300 border-b border-gray-200 text-black">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Time In</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Time Out</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Hours</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Notes</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($attendances as $att)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ \Carbon\Carbon::parse($att->date)->format('M d, Y') }}
                        <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($att->date)->format('l') }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-700">{{ $att->time_in ? \Carbon\Carbon::parse($att->time_in)->format('h:i A') : '—' }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $att->time_out ? \Carbon\Carbon::parse($att->time_out)->format('h:i A') : '—' }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $att->hours_worked > 0 ? $att->hours_worked . ' hrs' : '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium
                            @if($att->status === 'present') bg-green-100 text-green-700
                            @elseif($att->status === 'absent') bg-red-100 text-red-700
                            @elseif($att->status === 'late') bg-yellow-100 text-yellow-700
                            @elseif($att->status === 'half-day') bg-orange-100 text-orange-700
                            @else bg-blue-100 text-blue-700 @endif">
                            {{ ucfirst($att->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $att->notes ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">No attendance records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $attendances->links() }}</div>
</div>
</x-app-layout>