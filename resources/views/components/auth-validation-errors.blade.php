@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }} style="width: 400px; color: red; font-weight: bold;">
        <div class="font-medium text-red-600">
            {{ __('Kesalahan terjadi.') }}
        </div>

            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
    </div>
@endif
