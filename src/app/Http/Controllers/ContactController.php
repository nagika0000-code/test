<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

public function confirm(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:8',
        'last_name'  => 'required|string|max:8',
        'gender'     => 'required',

        'email'      => 'required|email',

        'tel1'       => 'required|regex:/^\d{1,5}$/',
        'tel2'       => 'required|regex:/^\d{1,5}$/',
        'tel3'       => 'required|regex:/^\d{1,5}$/',

        'address'    => 'required',
        'category_id'=> 'required',
        'detail'     => 'required|max:120',

    ], [
        'email.required' => 'メールアドレスを入力してください。',
        'email.email'    => 'メールアドレスはメール形式で入力してください。',

        'tel1.required' => '電話番号を入力してください。',
        'tel2.required' => '電話番号を入力してください。',
        'tel3.required' => '電話番号を入力してください。',

        'tel1.regex' => '電話番号は5桁までの半角数字で入力してください。',
        'tel2.regex' => '電話番号は5桁までの半角数字で入力してください。',
        'tel3.regex' => '電話番号は5桁までの半角数字で入力してください。',

        'category_id.required' => 'お問い合わせの種類を選択してください。',

        'detail.required' => 'お問い合わせ内容を入力してください。',
        'detail.max'      => 'お問い合わせ内容は120文字以内で入力してください。',
    ]);

    $input = $request->all();
    $input['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

    $category = Category::find($request->category_id);
    $input['category_name'] = $category ? $category->content : '未選択';

    return view('contact.confirm', compact('input'));
}


    public function store(Request $request)
    {
        Contact::create([
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'gender'      => $request->gender,
            'email'       => $request->email,
            'tel'         => $request->tel,
            'address'     => $request->address,
            'building'    => $request->building,
            'category_id' => $request->category_id,
            'detail'      => $request->detail,
        ]);

        return view('contact.thanks');
    }
}
