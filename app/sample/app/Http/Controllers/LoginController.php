<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;

// ログ出力用
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('comprehensive.login');
    }

    public function login(LoginRequest $request)
    {
        //リクエスト情報取得
        $employeeCode = $request->input('employeeCode');
        $password = $request->input('password');

        //usersテーブルを検索
        $user = User::getUserByUserIdAndPassword($employeeCode, $password);


        $message = '';
        //検索結果の判定
        if (is_null($user) || empty($user)) {
            $errorMessage = '入力された社員コードまたはパスワードが違います。';
            return back() //1つ前の入力画面に戻す
                ->withInput() //入力値を保持する
                ->withErrors(['errorMessage' => $errorMessage]);
        } else {
            $message = 'ようこそ！' . $user->name . 'さん！';
        }


        log::info($message);
        $responseData = [
            'message' => $message
            , 'employeeCode' => $employeeCode
        ];



        return view('comprehensive.home', ['responseData' => $responseData]);
    }
}
