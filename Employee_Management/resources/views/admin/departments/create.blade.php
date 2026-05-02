<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Add Department</h2>
            <p class="text-gray-600 text-sm mt-1">Create a new department in your organization</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow">
            <form method="POST" action="{{ route('admin.departments.store') }}" class="p-8 space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                        Department Name
                        <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text"
                        id="name"
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="e.g., Human Resources"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                        <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-2.687-2.687a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8z" clip-rule="evenodd"/></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Code Field -->
                <div>
                    <label for="code" class="block text-sm font-semibold text-gray-900 mb-2">
                        Code
                        <span class="text-gray-500 font-normal text-xs ml-1">(e.g., HR, IT, FIN)</span>
                    </label>
                    <input 
                        type="text"
                        id="code"
                        name="code" 
                        value="{{ old('code') }}" 
                        placeholder="HR"
                        maxlength="10"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition uppercase"
                    >
                    <p class="text-gray-500 text-xs mt-1">Short code for the department</p>
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">
                        Description
                    </label>
                    <textarea 
                        id="description"
                        name="description" 
                        rows="4"
                        placeholder="Brief description of this department's responsibilities..."
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"
                    >{{ old('description') }}</textarea>
                    <p class="text-gray-500 text-xs mt-1">Optional: Add details about this department</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <button type="submit" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Department
                    </button>
                    <a href="{{ route('admin.departments.index') }}" class="px-6 py-2.5 border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>