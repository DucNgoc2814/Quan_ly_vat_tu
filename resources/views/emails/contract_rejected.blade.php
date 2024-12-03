<h2>Kính gửi: {{ $contract->customer_name }},</h2>

<p>Bạn đã từ chối hợp đồng: {{ $contract->contract_number }} lúc {{ $contract->updated_at }}</p>

<p>Chúng tôi đã ghi nhận việc từ chối hợp đồng của bạn.</p>

<p>Trân trọng,</p>
<p>{{ config('app.name') }}</p>
