<?php

namespace App\Traits;

use Illuminate\Support\Facades\Request;

trait Toast {
    public static function show(string $title, string $message, string $type = 'success', bool $alwaysShow = false)
    {
        $toast = [
            'title'      => $title,
            'message'    => $message,
            'type'       => $type,
            'alwaysShow' => $alwaysShow
        ];

        Request::session()->flash('toast', $toast);
    }
}
