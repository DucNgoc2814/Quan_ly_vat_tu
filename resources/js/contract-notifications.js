window.Echo.channel('contract-notifications')
    .listen('ContractSentToCustomer', (e) => {
        console.log('Received event:', e);
        console.log('Contract data:', e.contract);
        Swal.fire({
            title: 'Thông báo mới',
            text: 'Hợp đồng đã được gửi cho khách hàng',
            icon: 'info'
        });
    });
