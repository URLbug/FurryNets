<?php

namespace App\Owners;

use Illuminate\Support\Facades\Storage;

final class S3Storage
{
    static function putFile(string $path, mixed $content): void
    {
        Storage::disk('s3')->put($path, $content);
    }
} 