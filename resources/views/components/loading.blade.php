@props(['message'])

<div class="loading-container" id="loading" style="display: none">
    <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <p>{{ $message }}</p>
</div>
