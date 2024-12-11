<div id="breadcrumb">
    @php
        $arr = array_slice(explode('/', Request::url()), 3);
        $i = -1;
        $url = '';
    @endphp

    @if (sizeof($arr) > 0)
        <a href="/" class="home">
            <i data-lucide="house"></i>
        </a>
    @else
        <p class="home">
            <i data-lucide="house"></i>
        </p>
    @endif

    @foreach ($arr as $lien)
    @php
        $url .= '/' . $lien;
        $i++;
    @endphp
        <div class="slash">/</div>
        @if ($i < sizeof($arr) - 1 || (isset($breadcrumLastLink) && $breadcrumLastLink))
            <a href="@if (isset($breadcrumReplaceLink) && isset($breadcrumReplaceLink[$url]))
                {{ $breadcrumReplaceLink[$url] }}
            @else
                {{ $url }}
            @endif">
                @if (isset($breadcrumReplaceName) && isset($breadcrumReplaceName[$url]))
                    {{ $breadcrumReplaceName[$url] }}
                @else
                    {{ $lien }}
                @endif
            </a>
        @else
            <p>
                @if (isset($breadcrumReplaceName) && isset($breadcrumReplaceName[$url]))
                    {{ $breadcrumReplaceName[$url] }}
                @else
                    {{ $lien }}
                @endif
            </p>
        @endif
    @endforeach
</div>
