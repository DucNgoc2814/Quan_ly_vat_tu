<h2>Kính gửi: {{ $contract->customer_name }},</h2>

<p>Chúng tôi gửi kèm theo đây hợp đồng {{ $contract->contract_name }}.</p>

<p>Vui lòng xem xét và phản hồi lại cho chúng tôi.</p>
<div style="margin: 20px 0;">

    <a href="{{ config('app.url') . route('contract.customerApprove', ['id' => $contract->id], false) }}"
        style="display: inline-block; padding: 10px 20px; background-color: #1b8332; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">
        Xác nhận hợp đồng
    </a>
    <a href="{{ config('app.url') . route('contract.customerReject', ['id' => $contract->id], false) }}"
        style="display: inline-block; padding: 10px 20px; background-color: #f33a4d; color: white; text-decoration: none; border-radius: 5px;">
        Từ chối hợp đồng
    </a>
</div>
<p>Trân trọng,</p>
<p>{{ config('app.name') }}</p>
