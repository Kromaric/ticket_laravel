<?php

namespace App\Services;

class ActivityLogReader
{
    public static function getLogs($limit = 50)
    {
        $path = storage_path('logs/activity.log');

        if (!file_exists($path)) {
            return [];
        }

        $lines = array_reverse(file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
        $logs = [];

        foreach ($lines as $line) {
            preg_match('/^\[(.*?)\] (\w+)\.(\w+): (.*?)({.*})$/', $line, $matches);
            if ($matches) {
                $json = json_decode($matches[5], true);
                $logs[] = [
                    'date' => $matches[1],
                    'channel' => $matches[2],
                    'level' => $matches[3],
                    'event' => trim($matches[4]),
                    'data' => is_array($json) ? $json : [],
                ];

            }
            else {
                Log::channel('activity')->warning('Log non parsé', ['line' => $line]);
            }

            if (count($logs) >= $limit) break;
        }

        return $logs;
    }
}
