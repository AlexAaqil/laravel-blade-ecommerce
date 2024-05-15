@props(['header_title', 'total_count', 'route'])

<div class="header">
    <h1>{{ $header_title }} <span>({{ $total_count }})</span></h1>
    <input type="text" name="search" id="myInput" onkeyup="searchFunction()" placeholder="Search">
    @if(isset($route))
        <div class="header_btn">
            <a href="{{ $route }}">New</a>
        </div>
    @endif
</div>