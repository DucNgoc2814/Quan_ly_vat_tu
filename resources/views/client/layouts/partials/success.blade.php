@if (session('success'))
    <div id="notification" class="notification-custom">
        <div class="notification-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        <div class="notification-content">
            <h4>Thành công!</h4>
            <p>{{ session('success') }}</p>
        </div>
    </div>
@endif
