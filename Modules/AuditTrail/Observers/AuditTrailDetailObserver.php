<?php

namespace Modules\AuditTrail\Observers;

use Illuminate\Support\Str;
use Modules\AuditTrail\Models\AuditTrailDetail;

class AuditTrailDetailObserver
{
    /**
     * Listen to the AuditTrailDetail "creating" event.
     *
     * @param AuditTrailDetail $auditTrailDetail
     * @return void
     */
    public function creating(AuditTrailDetail $auditTrailDetail): void
    {
        $auditTrailDetail->id = Str::uuid()->toString();
    }
}
