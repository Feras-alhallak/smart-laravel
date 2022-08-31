<?php

namespace Ferasalhallak\SmartLaravel\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ferasalhallak\SmartLaravel\Traits\HasS3Objects;

class Attachment extends BaseModel
{
    use HasS3Objects;

    protected $hidden = [
        'updated_at',
        'created_at',
        'attachmentable_type',
        'attachmentable_id',
    ];

    protected $fillable = [
        'attachment_path',
        'attachment_name'
    ];

    protected $s3Object = [
        'attachment_path',
    ];
}
