@extends('layouts.auth')

@section('content')

<!-- Validation Errors -->

<form class="ml-5 mt-10" method="POST" action="{{ route('domains.update', $domain) }}">
    @method('PUT')
    @csrf
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="grid gap-6 mb-6 md:grid-cols-1">
        <div>
            <label for="top_level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Domain Name</label>
            <input type="text" value="{{ old('top_level') ?? $domain->top_level }}" id="top_level" name="top_level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="example.com" required="true">
        </div>
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Domain Description</label>
            <input type="text" value="{{ old('description') ?? $domain->description }}" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Describe in details">
        </div>
    </div>
    <button type="submit" class="text-white bg-amber-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
</form>

@endsection