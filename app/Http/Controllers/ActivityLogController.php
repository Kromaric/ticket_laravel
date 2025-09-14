<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ActivityLogReader;
use Illuminate\Support\Str;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $level = $request->input('level');

        $logs = ActivityLogReader::getLogs(200); // Charger les 200 dernières lignes

        // Filtrage
        if ($level) {
            $logs = array_filter($logs, fn($log) => strtolower($log['level']) === strtolower($level));
        }

        if ($query) {
            $logs = array_filter($logs, function ($log) use ($query) {
                return str_contains(strtolower($log['event']), strtolower($query)) ||
                    collect($log['data'])->filter(fn($v) => str_contains(strtolower($v), strtolower($query)))->isNotEmpty();
            });
        }

        // Pagination manuelle
        $page = max(1, (int) $request->input('page', 1));
        $perPage = 10;
        $total = count($logs);
        $logs = array_slice($logs, ($page - 1) * $perPage, $perPage);
        $totalPages = ceil($total / $perPage);


        return view('admin.logs.index', [
            'logs' => $logs,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'query' => $query,
            'level' => $level,
            'totalPages' => $totalPages,
        ]);
    }
}
