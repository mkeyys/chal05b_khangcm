<?php

namespace App\Http\Controllers;


use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function getListQuiz() {
        $quiz = Quiz::all();
        return view('auth.list_quiz')->with(['quiz'=>$quiz]);
    }
    public function addQuiz(Request $request) {
        if ($request->hasFile('filename')) {
            $file = $request->file('filename');
            $file->move(
                'document/quiz',
                $file->getClientOriginalName()
            );
        } else {
            echo "Chưa có file";
        }
        $link = $request->file('filename')->getClientOriginalName();
        $quiz = new Quiz();
        $quiz->linkfiletxt = $link;
        $quiz->hint = $request->hint;
        $quiz->save();
        return redirect()->action('\App\Http\Controllers\QuizController@getListQuiz');
    }
    public function checkAnsQuiz(Request $request, $link) {
        $ans = $request->ansquiz;
        $linkans = $ans.'.txt';
        $linkroot='document/quiz/'.$link;
        if (strtoupper($linkans) == strtoupper($link)) {
            return view('auth.content_file', ['linkfile'=>$linkroot]);
        } else return redirect()->back()->with('alert','Bạn trả lời sai rồi');
    }
}
