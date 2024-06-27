@props(['header_title', 'total_count', 'route'])

<div class="header">
    <p>{{ $header_title }} <span>({{ $total_count }})</span></p>
    <input type="text" name="search" id="myInput" onkeyup="searchFunction()" placeholder="Search">
    @if(isset($route))
        <div class="header_btn">
            <a href="{{ $route }}">New</a>
        </div>
    @endif
</div>