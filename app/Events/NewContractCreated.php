<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewContractCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $contract;
    public function __construct($contract)
    {
        $this->contract = $contract;
    }
    public function broadcastOn(): Channel
    {
        return  new Channel('contract-created');
    }
    public function broadcastWith()
    {
        return [
            'message' => "Hợp đồng {$this->contract->contract_number} đã được thêm mới",
            'contract' => $this->contract
        ];
    }
}