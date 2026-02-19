<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactAdminController extends Controller
{
    public function index(Request $request)
    {
        $contactQuery = $this->makeSearchQuery($request);

        $contactList = $contactQuery->latest()->paginate(7)->withQueryString();
        $categoryList = Category::all();

        return view('admin.index', [
            'contacts' => $contactList,
            'categories' => $categoryList,
        ]);
    }

    public function export(Request $request)
    {
        $contactQuery = $this->makeSearchQuery($request);
        $contactList = $contactQuery->latest()->get();

        $fileName = 'contacts.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($contactList) {
            $out = fopen('php://output', 'w');

            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, ['お名前', '性別', 'メール', '種類', '内容', '登録日']);

            foreach ($contactList as $contact) {
                $genderText = $contact->gender == 1 ? '男性'
                            : ($contact->gender == 2 ? '女性' : 'その他');

                fputcsv($out, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $genderText,
                    $contact->email,
                    optional($contact->category)->content,
                    $contact->detail,
                    $contact->created_at,
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function makeSearchQuery(Request $request)
    {
        $contactQuery = Contact::query()->with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $contactQuery->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $contactQuery->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $contactQuery->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $contactQuery->whereDate('created_at', $request->date);
        }

        return $contactQuery;
    }

    public function destroy(Contact $contact)
    {
    $contact->delete();

    return redirect()
        ->route('admin.index')
        ->with('success', '削除しました。');
}

}
