<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\PerformAchievement;
use Illuminate\Http\Request;

class PerformAchievementController extends Controller
{
    //
    public function index()
    {
        $assessments = Assessment::latest()->get();
        $perform_achievements = PerformAchievement::with('assessment')->latest()->get();

        return view('settings.perform_achievement.index', compact('assessments', 'perform_achievements'));
    }

    public function store(Request $request)
    {
        PerformAchievement::create([
            'aspect_id' => $request->aspect_id,
            'name' => $request->name,
            'grade' => $request->grade
        ]);

        return back()->with('success', 'Berhasil menambahkan kategori pencapaian');
    }

    public function update(Request $request, $id)
    {
        PerformAchievement::where('id', $id)->update([
            'aspect_id' => $request->aspect_id,
            'name' => $request->name,
            'grade' => $request->grade
        ]);

        return back();
    }

    public function destroy($id)
    {
        PerformAchievement::where('id', $id)->delete();

        return back()->with('success', 'Berhasil menghapus pencapaian kinerja');
    }
}
