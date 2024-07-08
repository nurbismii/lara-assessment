<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\PerformAchievement;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    //
    public function index()
    {
        $assessments = Assessment::latest()->get();

        return view('settings.assessment_aspect.index', compact('assessments'));
    }

    public function store(Request $request)
    {
        Assessment::create([
            'name' => $request->name,
            'atribut' => $request->atribut,
            'bobot' => $request->bobot,
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        Assessment::where('id', $id)->update([
            'name' => $request->name,
            'atribut' => $request->atribut,
            'bobot' => $request->bobot,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $assessment = Assessment::where('id', $id)->firstOrFail();
        $perform_achieve = PerformAchievement::where('aspect_id', $assessment->id)->get();

        foreach ($perform_achieve as $row) {
            $row->delete();
        }
        $assessment->delete();

        return back();
    }
}
