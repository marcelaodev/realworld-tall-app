@if ($errors->any())
    <div {{ $attributes }}>
        <ul class="error-messages">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif