<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ErrorLogController extends Controller implements HasMiddleware
{
    /**
     * Max characters read from the tail of the log file, to keep the
     * page responsive even if the log has grown large.
     */
    protected const MAX_BYTES = 200000;

    public static function middleware(): array
    {
        return [
            new Middleware('permission:users.view'),
        ];
    }

    public function index(): View
    {
        $path = storage_path('logs/laravel.log');
        $entries = [];

        if (is_file($path)) {
            $size = filesize($path);
            $offset = max(0, $size - self::MAX_BYTES);

            $handle = fopen($path, 'r');
            fseek($handle, $offset);
            $contents = fread($handle, self::MAX_BYTES);
            fclose($handle);

            preg_match_all('/^\[(?<date>\d{4}-\d{2}-\d{2}[^\]]+)\]\s+\w+\.(?<level>\w+):\s(?<message>.*?)(?=^\[\d{4}-\d{2}-\d{2}|\z)/ms', $contents, $matches, PREG_SET_ORDER);

            $entries = array_reverse(array_slice($matches, -100));
        }

        return view('admin.error-log.index', compact('entries'));
    }
}
