@if (session()->has('flash_notification.message'))
    <div class="notification is-primary"
        style="position: fixed; bottom: 10px; right: 10px; margin-bottom: 0; z-index: 99999;">
        <button class="delete"></button>
        <span>{!! session('flash_notification.message') !!}</span>
    </div>
@endif
