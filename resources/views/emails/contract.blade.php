<h2>Kính gửi {{ $contract->customer_name }},</h2>

<p>Chúng tôi gửi kèm theo đây hợp đồng {{ $contract->contract_name }}.</p>

<p>Vui lòng xem xét và phản hồi lại cho chúng tôi.</p>
<div style="margin: 20px 0;">
    {{-- <a href="{{ route('contract.customerApprove', ['id' => $contract->id, 'token' => $token]) }}"
       style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">
        Xác nhận hợp đồng
    </a> --}}

    <a href="{{ route('contract.customerApprove', ['id' => $contract->id]) }}"
        style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px; margin-bottom: 10px;">
         Xác nhận hợp đồng
     </a>

    <a href="{{ route('contract.customerReject', ['id' => $contract->id, 'token' => $token]) }}"
       style="display: inline-block; padding: 10px 20px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 5px;">
        Từ chối hợp đồng
    </a>
</div>
<p>Trân trọng,</p>
<p>{{ config('app.name') }}</p>