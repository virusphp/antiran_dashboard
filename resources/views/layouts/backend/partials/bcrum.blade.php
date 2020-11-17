<!-- Breadcrumb-->
<div class="c-subheader px-3">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ $bcrum['url-first'] }}">{{ $bcrum['name-first'] }}</a></li>
        @if(isset($bcrum['url-second']))
        <li class="breadcrumb-item"><a href="{{ $bcrum['url-second'] }}">{{ $bcrum['name-second'] }}</a></li>
        @endif
        <li class="breadcrumb-item">{{ $bcrum['current'] }}</li>
    </ol>
</div>
<!-- Breadcrumb Menu-->