@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }} >
        <div class="font-medium text-red-600 alert alert-danger">
            {{ __('Whoops! Something went wrong.') }}
        </div>
        {{-- mt-3
        list-disc
        list-inside 
        text-sm 
        text-red-600 --}}
        <ul class="  list-group" >
            @foreach ($errors->all() as $error)
                <li class="list-group-item alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
