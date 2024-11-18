<h2>Kính gửi: {{ $contract->customer_name }},</h2>

<p>Chúng tôi gửi kèm theo đây hợp đồng {{ $contract->contract_name }}.</p>

<p>Vui lòng xem xét và phản hồi lại cho chúng tôi.</p>
<div style="margin: 20px 0;">
<<<<<<< HEAD
    @if($contract->contract_status_id != 6 && $contract->contract_status_id != 7)
    <a href="{{ config('app.url') . route('contract.customerApprove', ['id' => $contract->id], false) }}"
        style="display: inline-block; padding: 10px 20px; background-color: #93e7a7; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">
        Xác nhận hợp đồng
    </a>

    <a href="{{ route('contract.customerReject', ['id' => $contract->id, 'token' => $token]) }}"
        style="display: inline-block; padding: 10px 20px; background-color: #ec9099; color: white; text-decoration: none; border-radius: 5px;">
=======

    <a href="{{ config('app.url') . route('contract.customerApprove', ['id' => $contract->id], false) }}"
        style="display: inline-block; padding: 10px 20px; background-color: #1b8332; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">
        Xác nhận hợp đồng
    </a>
    <a href="{{ config('app.url') . route('contract.customerReject', ['id' => $contract->id], false) }}"
        style="display: inline-block; padding: 10px 20px; background-color: #f33a4d; color: white; text-decoration: none; border-radius: 5px;">
>>>>>>> ab9a32da90a8547732394c72f61de6353175478a
        Từ chối hợp đồng
    </a>
@else
    <p style="font-weight: bold; color: #666;">
        Hợp đồng này đã được {{ $contract->contract_status_id == 6 ? 'xác nhận' : 'từ chối' }}
    </p>
@endif
</div>
<p>Trân trọng,</p>
<p>{{ config('app.name') }}</p>
