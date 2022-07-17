<div class="p-4 mb-4 text-sm text-{{ $type }}-700 bg-{{ $type }}-100 rounded-lg dark:bg-{{ $type }}-200 dark:text-{{ $type }}-800" role="alert">
  <span class="font-medium">Alert!</span> {!! $message !!}.

  {!! $slot !!}
</div>