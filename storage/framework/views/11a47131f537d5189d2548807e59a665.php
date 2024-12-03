<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo e(asset('themes/admin/assets/images/gemo2.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(asset('themes/admin/assets/images/gemo2.png')); ?>" alt=""
                                height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo e(asset('themes/admin/assets/images/gemo2.png')); ?>" alt=""
                                height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(asset('themes/admin/assets/images/gemo2.png')); ?>" alt=""
                                height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                            id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="dropdown-item bg-transparent text-wrap">
                                <a href="index.html" class="btn btn-soft-secondary btn-sm rounded-pill">how to
                                    setup <i class="mdi mdi-magnify ms-1"></i></a>
                                <a href="index.html" class="btn btn-soft-secondary btn-sm rounded-pill">buttons
                                    <i class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="<?php echo e(asset('themes/admin/assets/images/users/avatar-2.jpg')); ?>"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Angela Bernier</h6>
                                            <span class="fs-11 mb-0 text-muted">Manager</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="<?php echo e(asset('themes/admin/assets/images/users/avatar-3.jpg')); ?>"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">David Grasso</h6>
                                            <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="<?php echo e(asset('themes/admin/assets/images/users/avatar-5.jpg')); ?>"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Mike Bunch</h6>
                                            <span class="fs-11 mb-0 text-muted">React Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All
                                Results <i class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <?php if($noti > 0): ?>
                            <span class="position-absolute translate-middle badge p-1 bg-danger rounded-circle"
                                style="top: 10px; left: 30px;">
                                <?php echo e(count($lowStockProducts) + count($transactions)); ?>

                            </span>
                        <?php endif; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 " style="width: 450px; "
                        aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white">Thông báo </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2 ">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                    id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light w-50">
                                        <a class="nav-link active text-center" data-bs-toggle="tab"
                                            href="#all-noti-tab" role="tab" aria-selected="true">
                                            Tồn kho (<?php echo e(count($lowStockProducts)); ?>)
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light w-50">
                                        <a class="nav-link text-center" data-bs-toggle="tab" href="#messages-tab"
                                            role="tab" aria-selected="false">
                                            Giao dịch (<?php echo e(count($transactions)); ?>)
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span
                                                        class="avatar-title bg-warning-subtle text-warning rounded-circle fs-16">
                                                        <i class='bx bx-package'></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Cảnh báo tồn kho thấp
                                                        </h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">Sản phẩm "<?php echo e($product->product->name); ?>"
                                                            (<?php echo e($product->name); ?>)
                                                            có số lượng tồn kho thấp:
                                                            <?php echo e($product->stock); ?></p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> Vui lòng nhập thêm
                                                            hàng</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>


                            <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel"
                                aria-labelledby="messages-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <?php if(isset($transactions) && $transactions->count() > 0): ?>
                                        <?php $__currentLoopData = $transactions->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="text-reset notification-item d-block dropdown-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs me-3">
                                                            <span
                                                                class="avatar-title bg-soft-warning text-warning rounded-circle fs-16">
                                                                <?php if($transaction->transaction_type == 'contract'): ?>
                                                                    <i class="ri-file-list-3-line fs-12"></i>
                                                                <?php elseif($transaction->transaction_type == 'sale'): ?>
                                                                    <i class="ri-shopping-cart-line fs-12"></i>
                                                                <?php else: ?>
                                                                    <i class="ri-shopping-basket-line fs-12"></i>
                                                                <?php endif; ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">
                                                            <?php if($transaction->transaction_type == 'contract'): ?>
                                                                <a href="<?php echo e(route('contract.show', $transaction->related_id)); ?>"
                                                                    class="text-reset">
                                                                    Hợp đồng
                                                                    #<?php echo e($transaction->contract_number ?? $transaction->related_id); ?>

                                                                </a>
                                                            <?php elseif($transaction->transaction_type == 'sale'): ?>
                                                                Bán hàng
                                                                #<?php echo e($transaction->slug ?? $transaction->related_id); ?>

                                                            <?php else: ?>
                                                                Mua hàng
                                                                #<?php echo e($transaction->slug ?? $transaction->related_id); ?>

                                                            <?php endif; ?>
                                                            <br><span class="text-warning">Chờ xác nhận</span>
                                                        </h6>
                                                        <div class="fs-13 text-muted">
                                                            <p class="mb-1">
                                                                Số tiền: <?php echo e(number_format($transaction->amount)); ?> VNĐ
                                                                <br>
                                                                Nội dung: <?php echo e($transaction->note); ?>

                                                            </p>
                                                        </div>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i>
                                                                <?php echo e(\Carbon\Carbon::parse($transaction->created_at)->diffForHumans()); ?>

                                                            </span>
                                                        </p>
                                                    </div>
                                                    <?php if($transaction->document): ?>
                                                        <div class="px-2 fs-15">
                                                            <button type="button"
                                                                class="btn btn-sm btn-icon btn-ghost-info"
                                                                onclick="showDocument('<?php echo e(url('storage/' . $transaction->document)); ?>', '<?php echo e(pathinfo($transaction->document, PATHINFO_EXTENSION)); ?>')">
                                                                <i class="ri-file-text-line"></i>
                                                            </button>
                                                        </div>
                                                    <?php endif; ?>
                                                    <button type="button" class="btn btn-sm btn-ghost-success"
                                                        onclick="confirmTransaction('<?php echo e($transaction->transaction_type); ?>', <?php echo e($transaction->id); ?>)">
                                                        Xác nhận
                                                        <i class="ri-check-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    <?php else: ?>
                                        <div class="text-center p-4">
                                            <div class="avatar-md mx-auto mb-4">
                                                <div class="avatar-title bg-light rounded-circle text-primary fs-20">
                                                    <i class="ri-exchange-line"></i>
                                                </div>
                                            </div>
                                            <h5 class="mb-1">Không có giao dịch nào!</h5>
                                            <p class="text-muted mb-0">
                                                Chưa có giao dịch nào được thực hiện.
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel"
                                aria-labelledby="alerts-tab"></div>

                            <div class="notification-actions" id="notification-actions">
                                <div class="d-flex text-muted justify-content-center">
                                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div>
                                    Result <button type="button" class="btn btn-link link-danger p-0 ms-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#removeNotificationModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn" type="button" id="chat-icon">
                        <i class="ri-message-3-line fs-22"></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                    
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Founder</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?php echo e(route('employees.logOut')); ?>"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="chat-box" class="chat-box-wrapper" style="display: none;">
        <div class="chat-box">
            <div class="chat-header">
                <h5 class="mb-0">Chat Box GEMO</h5>
                <button class="btn-close" id="close-chat"></button>
            </div>
            <div class="chat-body" id="chat-messages">
                <!-- Messages here -->
            </div>
            <div class="chat-footer">
                <div class="input-group">
                    <input type="text" class="form-control" id="chat-input" placeholder="Nhập tin nhắn...">
                    <button class="btn btn-primary" type="button" id="send-chat">
                        <i class="ri-send-plane-line"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<?php $__env->startSection('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lowStockProducts = <?php echo json_encode($lowStockProducts, 15, 512) ?>;

            function showLowStockNotifications() {
                const notificationContainer = document.querySelector('#all-noti-tab .simplebar-content');
                const notificationBadge = document.querySelector('.topbar-badge');
                if (notificationBadge) {
                    notificationBadge.textContent = lowStockProducts.length;
                }
            }

            showLowStockNotifications();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const employee_id = "<?php echo e(Session::get('employee_id')); ?>";
            const token = "<?php echo e(Session::get('token')); ?>";
            if (token) {
                axios.defaults.headers.common = {
                    'Authorization': 'Bearer ' + token,
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                };
            }

            const chatIcon = document.getElementById('chat-icon');
            const chatBox = document.getElementById('chat-box');
            const closeChat = document.getElementById('close-chat');
            const chatInput = document.getElementById('chat-input');
            const sendChat = document.getElementById('send-chat');
            const chatMessages = document.getElementById('chat-messages');
            const currentUserId = "<?php echo e(auth()->id()); ?>";

            chatIcon.addEventListener('click', function() {
                chatBox.style.display = chatBox.style.display === 'none' ? 'block' : 'none';
                loadMessages();
            });

            closeChat.addEventListener('click', function() {
                chatBox.style.display = 'none';
            });

            sendChat.addEventListener('click', sendMessage);

            function sendMessage() {
                const message = chatInput.value.trim();
                if (!message) return;

                axios.post('/chat/messages', {
                        message: message
                    })
                    .then(response => {
                        chatInput.value = '';
                        console.log('Success:', response.data);
                    })
                    .catch(error => {
                        console.log('Error details:', error.response?.data);
                    });
            }


            function loadMessages() {
                axios.get('/chat/messages')
                    .then(response => {
                        displayMessages(response.data);
                    });
            }

            function displayMessages(messages) {
                chatMessages.innerHTML = messages.map(msg => {
                    const messageClass = msg.employee_id == currentUserId ? 'sent' : 'received';
                    return `
                    <div class="message ${messageClass}">
                        <strong>${msg.employee.name}:</strong> ${msg.message}
                    </div>
                `;
                }).join('');
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            window.Echo.channel('chat')
                .listen('NewMessage', (e) => {
                    const messageClass = e.message.employee_id == currentUserId ? 'sent' : 'received';
                    const newMessage = `
                    <div class="message ${messageClass}">
                        <strong>${e.message.employee.name}:</strong> ${e.message.message}
                    </div>
                `;
                    chatMessages.innerHTML += newMessage;
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                });
        });

        let dropdown = document.querySelector('#notificationDropdown .dropdown-menu');

        function showDropdown(dropdown) {
            dropdown.classList.add('show'); // Hiển thị dropdown ngay khi trang tải
        }

        function showDocument(url, type) {

            let dropdown = document.querySelector('#notificationDropdown .dropdown-menu');
            Swal.fire({
                imageUrl: url,
                imageWidth: 800,
                imageHeight: 'auto',
                imageAlt: 'Chứng từ',
                showCloseButton: true,
                showConfirmButton: false,
                backdrop: false,
                willClose: () => {
                    if (dropdown) {
                        showDropdown(dropdown)
                    }
                }
            });
        }


        // Thêm hàm xác nhận giao dịch
        function confirmTransaction(type, id) {
            event.stopPropagation();

            Swal.fire({
                title: 'Xác nhận',
                text: "Bạn có chắc chắn muốn xác nhận giao dịch này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    axios.post(`/lich-su-chuyen-tien/xac-nhan/${id}`, {}, {
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        console.log('Success Response:', response);
                        if (response.data && response.data.success) {
                            Swal.fire({
                                title: 'Thành công!',
                                text: response.data.message || 'Giao dịch đã được xác nhận.',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            throw new Error(response.data?.message || 'Có lỗi xảy ra');
                        }
                    })
                    .catch(error => {
                        console.error('Error details:', {
                            error: error,
                            response: error.response,
                            status: error.response?.status,
                            data: error.response?.data
                        });

                        Swal.fire({
                            title: 'Lỗi!',
                            text: error.response?.data?.message || 'Có lỗi xảy ra khi xác nhận giao dịch',
                            icon: 'error'
                        });
                    });
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\laragon\www\DuAnTotNghiep\resources\views/admin/layouts/partials/header.blade.php ENDPATH**/ ?>