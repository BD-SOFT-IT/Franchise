<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        @forelse($data as $item)
            <li class="breadcrumb-item">
                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
            </li>
        @empty
        @endforelse
        <li class="breadcrumb-item active" aria-current="page">
            {{ $active }}
        </li>
    </ol>
</nav>
