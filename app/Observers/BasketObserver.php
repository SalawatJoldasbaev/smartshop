<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\QrCode;
use Illuminate\Support\Str;

class BasketObserver
{
    /**
     * Handle the Basket "created" event.
     *
     * @param  \App\Models\Basket  $basket
     * @return void
     */
    public function created(Basket $basket)
    {
        $uuid = Str::uuid();
        $check = QrCode::where('uuid', $uuid)->first();
        while ($check) {
            $uuid = Str::uuid();
            $check = QrCode::where('uuid', $uuid)->first();
        }
        QrCode::create([
            'uuid' => $uuid,
            'type' => 'basket',
            'additional' => [
                'basket_id' => $basket->id
            ]
        ]);
    }

    /**
     * Handle the Basket "updated" event.
     *
     * @param  \App\Models\Basket  $basket
     * @return void
     */
    public function updated(Basket $basket)
    {
        //
    }

    /**
     * Handle the Basket "deleted" event.
     *
     * @param  \App\Models\Basket  $basket
     * @return void
     */
    public function deleted(Basket $basket)
    {
        //
    }

    /**
     * Handle the Basket "restored" event.
     *
     * @param  \App\Models\Basket  $basket
     * @return void
     */
    public function restored(Basket $basket)
    {
        //
    }

    /**
     * Handle the Basket "force deleted" event.
     *
     * @param  \App\Models\Basket  $basket
     * @return void
     */
    public function forceDeleted(Basket $basket)
    {
        //
    }
}
