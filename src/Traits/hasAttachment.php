<?php

namespace Ferasalhallak\SmartLaravel\Traits;

use App\Models\Attachment;

trait hasAttachment
{
    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachmentable');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

}
