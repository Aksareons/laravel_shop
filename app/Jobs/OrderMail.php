<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RegistrationMail;
use App\Models\Order;
use \Mail;
class OrderMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $order;
    private $orderItem;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $orderItem)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $i = 0;
        while ($i < 100){
            $i++;
            Mail::to($this->order->customerEmail)->queue(new RegistrationMail($this->order, $this->orderItem));

        }

    }
}
