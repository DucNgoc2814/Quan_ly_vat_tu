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

    public function broadcastAs()
    {
        return 'contract.updated';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->contract->id,
            'contract_status_id' => $this->contract->contract_status_id,
            'contract_status' => [
                'id' => $this->contract->contractStatus->id,
                'name' => $this->contract->contractStatus->name
            ]
        ];
    }
}
