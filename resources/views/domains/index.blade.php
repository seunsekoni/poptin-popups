@extends('layouts.auth')

@section('content')
<div class="grid w-full"> 
  <div class="text-right" >
      <button type="button" class="mt-4 text-white bg-amber-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-4 mb-2">
        <a href="{{ route('domains.create') }}">Create Domain</a>
    </button>
  </div>
</div>

<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Domain name
                </th>
                <th scope="col" class="py-3 px-6">
                    Description
                </th>
                <th scope="col" class="py-3 px-6">
                    Date Added
                </th>
                <th scope="col" class="py-3 px-6">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($domains as $domain)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{  $domain->top_level }}
                    </th>
                    <td class="py-4 px-6">
                        {{ $domain->description }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $domain->created_at->format('Y-m-d') }}
                    </td>
                    <td class="flex items-center py-4 px-6 space-x-3">
                        <a href="{{ route('domains.edit', $domain) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <a href="{{ route('popups.index', ['domain' => $domain]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Manage Popups</a>
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

@endsection
