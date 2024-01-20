<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $audits = Audit::select('audits.id', 'audits.user_id', 'audits.task_id', 'audits.task', 'audits.created_at')
        ->leftJoin('users', 'audits.user_id', '=', 'users.id')
        ->orderByDesc('audits.id')
        ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $audits
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $audit = Audit::create([
                'user_id' => $request->user_id,
                'task_id' => $request->task_id,
                'task' => $request->task,
            ]);

            return response()->json([
                'success' => true,
                'data' => $audit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
