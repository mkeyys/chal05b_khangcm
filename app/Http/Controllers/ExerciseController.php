<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
{
    public function getListExercise()
    {
        $topics = Exercise::select('topic')->distinct('')->get();
        $exercises = Exercise::all();
        return view('auth.list_exercise')->with(['topics'=>$topics,'exercises' => $exercises]);
    }

    public function addExercise(Request $request)
    {
        if ($request->hasFile('filename')) {
            $file = $request->file('filename');
            $file->move(
                'document/exercise',
                $file->getClientOriginalName()
            );
        } else {
            echo "Chưa có file";
        }
        $link = 'document/exercise/' . $request->file('filename')->getClientOriginalName();
        $exercise = new Exercise();
        $exercise->topic = $request->topic;
        $exercise->exercise = $link;
        $exercise->solution = 'null';
        $exercise->user_submit = Auth::user()->username;
        $exercise->save();
        return redirect()->action('\App\Http\Controllers\ExerciseController@getListExercise');
    }

    public function uploadSolution(Request $request, $topic)
    {
        $exercise_upload = Exercise::where('topic', $topic)->first()->exercise;
        if ($request->hasFile('filename')) {
            $file = $request->file('filename');
            $file->move(
                'document/solution',
                $file->getClientOriginalName()
            );
        } else {
            echo "Chưa có file";
        }
        $auth = Auth::user()->username;
        $link = 'document/solution/' . $request->file('filename')->getClientOriginalName();
        $solution = DB::select(DB::raw("SELECT * FROM `exercise` WHERE topic='$topic' and user_submit='$auth'"));
        if($solution) DB::statement("UPDATE `exercise` SET solution='$link' WHERE topic='$topic' and user_submit='$auth'");
        else {
            $ex_upload = new Exercise();
            $ex_upload->topic = $topic;
            $ex_upload->exercise = $exercise_upload;
            $ex_upload->solution = $link;
            $ex_upload->user_submit = Auth::user()->username;
            $ex_upload->save();
            return redirect()->back();
        }
        return redirect()->action('\App\Http\Controllers\ExerciseController@getListExercise');
    }
}
