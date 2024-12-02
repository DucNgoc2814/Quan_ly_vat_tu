<h2>Kính gửi: {{ $contract->customer_name }},</h2>

<p>Bạn đã xác nhận hợp đồng: {{ $contract->contract_number }} lúc {{ $contract->updated_at }}</p>

<p>Chúng tôi đã đính kèm bản hợp đồng đã được ký trong email này.</p>

<p>Trân trọng,</p>
<p>{{ config('app.name') }}</p>
