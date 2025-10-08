@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-2xl p-8 mt-10">
        <h2 class="text-2xl font-semibold mb-6">Edit Permission</h2>
        <p class="text-gray-500 mb-8">Set permission details</p>

        <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
            @csrf
            @method('PUT')

            <!-- Permission Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Permission Name</label>
                <input type="text" name="name" value="{{ old('name', $permission->name) }}"
                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Submit -->
            <div class="flex justify-end mt-8 space-x-3">
                <button type="submit"
                    class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Submit</button>
                <a href="{{ route('permissions.index') }}"
                    class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</a>
            </div>
        </form>
    </div>
@endsection
