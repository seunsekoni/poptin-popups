@extends('layouts.auth')

@section('content')
<form>
  	<div class="mx-4 my-6 grid w-full grid-cols-7 bg-gray-100">
		<div class="col-span-1 pr-4">
			<select id="countries" class="block w-full border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:text-blue-400 focus:ring-blue-500">
				<option selected>Select Rule</option>
				<option value="">Pages that contain</option>
				<option value="">A specific page</option>
				<option value="">Pages starting with</option>
				<option value="">Pages ending with</option>
			</select>
		</div>
    	<div class="col-span-1 pr-4">
			<select id="countries" class="block w-full border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:text-blue-400 focus:ring-blue-500">
				<option selected>Select Rule</option>
				<option value="">Pages that contain</option>
				<option value="">A specific page</option>
				<option value="">Pages starting with</option>
				<option value="">Pages ending with</option>
			</select>
		</div>
		<div class="col-span-2">
			<div>
				<div class="flex">
					<label for="first_name" class="mt-2 w-4/12 pr-3 text-right text-sm font-medium text-gray-900">User Alert Input</label>
					<input type="text" class="block w-6/12 border border-gray-300 bg-gray-50 p-2.5 text-left text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="" />
				</div>
			</div>
		</div>
		<div class="col-span-3">
			<div>
				<div class="flex">
					<label for="first_name" class="mt-2 w-4/12 pr-3 text-right text-base font-medium text-gray-900">www.domain.com/</label>
					<input type="text" class="block w-6/12 border border-gray-300 bg-gray-50 p-2.5 text-left text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="" />
					<button type="submit" class="py-2.0 ml-2 w-full rounded-lg bg-red-700 px-4 text-center text-sm font-medium text-white sm:w-auto">X</button>
				</div>
			</div>
		</div>
  	</div>
	<div id="appendNewRows" class="mx-4 my-6 grid w-full grid-cols-7 bg-gray-100"></div>
  	<button id="addRule" class=" ml-5 rounded bg-amber-700 hover:bg-blue-700 py-2 px-4 text-white"> Add Rule</button>
</form>

@endsection

@once
    @push('scripts')
        @include('scripts.dashboard-scripts')
    @endpush
@endonce