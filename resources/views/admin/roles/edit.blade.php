@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-2xl p-8 mt-10">
        <h2 class="text-2xl font-semibold mb-6">Edit Role</h2>
        <p class="text-gray-500 mb-8">Set role permissions</p>

        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            <!-- Role Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}"
                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Role Permissions -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Role Permissions</h3>

                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="select_all" class="rounded text-indigo-600">
                        <label for="select_all" class="text-sm text-gray-600">Select All</label>
                    </div>
                </div>

                <!-- Permissions Table -->
                <div class="divide-y divide-gray-200">
                    @foreach ($permissionGroups as $groupName => $permissions)
                        <div class="py-3 grid grid-cols-4 items-center">
                            <div class="font-medium text-gray-700">{{ $groupName }}</div>
                            <div class="col-span-3 flex gap-8">
                                @foreach ($permissions as $perm)
                                    <label class="inline-flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                                            class="rounded text-indigo-600"
                                            {{ in_array($perm->name, $rolePermissions) ? 'checked' : '' }}>
                                        <span
                                            class="text-gray-700 capitalize">{{ Str::after($perm->name, $groupName . ' ') }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end mt-8 space-x-3">
                <button type="submit"
                    class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Submit</button>
                <a href="{{ route('roles.index') }}"
                    class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('select_all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
@endsection
