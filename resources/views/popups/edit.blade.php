@extends('layouts.auth')

@section('content')

<div class="grid w-full"> 
  <div class="text-right" >
      <button type="button" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-4 mb-2">
        <a href="{{ route('popups.index', ['domain' => $domain]) }}">View Popups</a>
    </button>
  </div>
</div>

<form action="{{ route('popups.update', ['domain' => $domain, 'popup' => $popup]) }}" method="POST" class="ml-5 mt-10">
	<x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    @method('PUT')
	@csrf
  	<div id="appendNewRows" class="">
		<div class="ruleRow mx-4 my-6 grid w-full grid-cols-7 bg-gray-100">
			<div class="col-span-1 pr-4">
				<select id="status" name="status" class="block w-full border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:text-blue-400 focus:ring-blue-500">
					<option {{ $popup->status ? 'selected' : '' }} value="1">Show on</option>
					<option {{ !$popup->status ? 'selected' : '' }} value="0">Don't Show</option>
				</select>
			</div>
			<div class="col-span-1 pr-4">
				<select id="rules" name="rule" class="block w-full border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:text-blue-400 focus:ring-blue-500">
						@foreach($rules as $key => $value)
							<option {{ $popup->rule == $key ? 'selected': '' }} value="{{ $key }}">{{ $value }}</option>
						@endforeach
				</select>
			</div>
			<div class="col-span-2">
				<div>
					<div class="flex">
						<label for="text" class="mt-2 w-4/12 pr-3 text-right text-sm font-medium text-gray-900">Alert Text</label>
						<input value="{{ $popup->text }}" name="text" type="text" class="block w-6/12 border border-gray-300 bg-gray-50 p-2.5 text-left text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="" />
					</div>
				</div>
			</div>
			<div class="col-span-3">
				<div>
					<div class="flex">
						<label for="pages" class="mt-2 w-4/12 pr-3 text-right text-base font-medium text-gray-900">www.{{ $domain->top_level }}/</label>
						<input id="pages" value="{{ $popup->page }}" name="page" type="text" class="block w-6/12 border border-gray-300 bg-gray-50 p-2.5 text-left text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="" />
					</div>
				</div>
			</div>
		</div>
  	</div>
  	<button type="submit" class="ml-4 text-right rounded bg-blue-700 hover:bg-blue-700 py-2 px-4 text-white">Update</button>
</form>

@endsection