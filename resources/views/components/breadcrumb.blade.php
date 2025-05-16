<!-- resources/views/components/breadcrumb.blade.php -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent m-0 px-0 py-0 pt-4">
        <li class="breadcrumb-item">

            <a href="{{route('home')}}" class="font-weight-bold text-white">Home</a>

        </li>
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item text-white">
                @if (isset($breadcrumb['url']))
                    <a href="{{ $breadcrumb['url'] }}" class="text-white">{{ $breadcrumb['title'] }}</a>
                @else
                    {{ $breadcrumb['title'] }}
                @endif
            </li>
        @endforeach
    </ol>

    <b class="text-white m-0 p-0 text-uppercase" style="letter-spacing: 1.5px">{{$title}}</b>
</nav>
