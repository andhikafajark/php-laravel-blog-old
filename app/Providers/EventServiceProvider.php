<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\AuditTrail\Models\AuditTrail;
use Modules\AuditTrail\Models\AuditTrailDetail;
use Modules\AuditTrail\Observers\AuditTrailDetailObserver;
use Modules\AuditTrail\Observers\AuditTrailObserver;
use Modules\Blog\Models\Blog;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Observers\BlogCategoryObserver;
use Modules\Blog\Observers\BlogObserver;

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
     * The model observers for your application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $observers = [
        AuditTrail::class => [AuditTrailObserver::class],
        AuditTrailDetail::class => [AuditTrailDetailObserver::class],
        User::class => [UserObserver::class],
        // Modules\Blog
        Blog::class => [BlogObserver::class],
        BlogCategory::class => [BlogCategoryObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
