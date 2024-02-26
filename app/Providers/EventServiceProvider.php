<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\PaymentReceived;
use App\Events\RefundCreated;
use App\Events\ShipmentCreated;
use App\Events\ShipmentDeleted;
use App\Listeners\SendNewOrderNotification;
use App\Listeners\SendOrderConfirmation;
use App\Listeners\SendRefundNotification;
use App\Listeners\SendShipmentConfirmation;
use App\Listeners\SyncCartOnLogin;
use App\Listeners\UpdateOrderPaymentStatus;
use App\Listeners\UpdateOrderShippingStatus;
use App\Settings\GeneralSetting;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelSettings\Events\SettingsSaved;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
