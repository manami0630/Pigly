<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightRequest;
use App\Http\Requests\WeightLogRequest;
use App\Http\Requests\WeightTargetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightController extends Controller
{
    public function admin()
    {
        $weight_logs = WeightLog::paginate(8);
        $target = WeightTarget::find(1);
        $latestLog = WeightLog::latest()->first();

        if (!$target || !$latestLog) {
            return view('admin');
        }

        $target_weight = $target->target_weight;
        $latest_weight = $latestLog->weight;
        $difference = $target_weight - $latest_weight;

        return view('admin', compact('weight_logs','target_weight', 'latest_weight', 'difference'));
    }

    public function updateGoal(WeightTargetRequest $request)
    {
        $target = WeightTarget::find(1);

        if ($target) {
            $target->target_weight = $request->target_weight;
            $target->save();
        } else {
            WeightTarget::create([
                'user_id' => auth()->user()->id,
                'target_weight' => $request->target_weight,
            ]);
        }
        return redirect('/weight_logs');
    }

    public function store(WeightRequest $request)
    {
        $validated = $request->validated();

        $user_id = auth()->id();

        WeightTarget::create([
            'user_id' => $user_id,
            'target_weight' => $validated['target_weight'],
        ]);

        WeightLog::create([
            'user_id' => $user_id,
            'date' => now(),
            'weight' => $validated['weight'],
        ]);

        return redirect('/weight_logs');
    }

    public function settings()
    {
        $userId = auth()->user()->id;

        return view('settings', ['user_id' => $userId]);
    }

    public function update(WeightLogRequest $request, $id)
    {
        $weight_log = WeightLog::findOrFail($id);
        $weight_log->update($request->validated());

        return redirect('/weight_logs');
    }

    public function destroy($id)
    {
        $weight_log = WeightLog::findOrFail($id);
        $weight_log->delete();

        return redirect('/weight_logs');
    }

    public function details($id)
    {
        $weight_log = WeightLog::find($id);

        return view('details', compact('weight_log'));
    }

    public function initial()
    {
        return view('initial');
    }

    public function show(WeightLogRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = auth()->id();

        WeightLog::create($validatedData);
        return redirect('/weight_logs');
    }



    public function search(Request $request)
{
    try {
        $query = WeightLog::query();

        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        $weight_logs = $query->orderBy('date', 'desc')->get();

        return view('admin', compact('weight_logs'));
    } catch (\Exception $e) {
        // エラー原因を確認しやすくするために
        return back()->withErrors(['message' => '検索中にエラーが発生しました: ' . $e->getMessage()]);
    }
}
}
