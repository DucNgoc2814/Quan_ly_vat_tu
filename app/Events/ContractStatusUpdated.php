<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContractStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contract;

    public function __construct($contract)
    {
        $this->contract = $contract;
    }

    public function broadcastOn()
    {
        return new Channel('contract-status');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->contract->id,
            'contract_number' => $this->contract->contract_number,
            'customer_name' => $this->contract->customer_name,
            'customer_phone' => $this->contract->customer_phone,
            'total_amount' => $this->contract->total_amount,
            'paid_amount' => $this->contract->paid_amount,
            'contract_status_id' => $this->contract->contract_status_id,
            'employee_name' => $this->contract->employee->name,
            'contract_status' => $this->contract->contractStatus
        ];
    }
}
