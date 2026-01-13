<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Http\Requests\BookPostRequest;
use App\Http\Requests\BookPutRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    use AuthorizesRequests;
    public function index() : Response
    {
        $books = Book::with('category')
            ->orderBy('category_id')
            ->orderBy('title')
            ->get();   
        return response()
            ->view('admin/book/index',['books' => $books])
            ->header('Content-Type','text/html')
            ->header('Content-Encoding','UTF-8');
    }

    public function show(Book $book) : View
    {
        // //example-comのみ許可
        //$this->authorize('example-com-user');
        
        Log::info('書籍情報が参照されました。ID=' . $book->id);
        return view('admin/book/show', compact('book'));
    }

    public function create() : View
    {
        $categories = Category::all();
        $authors = Author::all();

        return view('admin/book/create',compact('categories','authors'));
    }

    public function edit(Book $book) : View
    {
        //カテゴリ全件取得
        $categories = Category::all();

        //著者全件取得
        $authors = Author::all();

        //書籍に紐づく著者ID一覧取得
        $authorIds = $book->authors()->pluck('id')->all();

        return view('admin/book/edit',compact('book','categories','authors','authorIds'));
    }

    public function update(BookPutRequest $request, Book $book) : RedirectResponse
    {
        //リクエストからパラメータ取得
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;

        DB::transaction(function() use($book, $request)
        {
            //更新
            $book->update();

            //書籍と著者の情報を紐づけ
            $book->authors()->sync($request->author_ids);
        });

        return redirect(route('book.index'))->with('message',$book->title . 'を変更しました。' );
    }

    public function destroy(Book $book) : RedirectResponse
    {
        // 削除
        $book->delete();
        return redirect(route('book.index'))->with('message',$book->title . 'を削除しました。' );
    }
    
    public function store(BookPostRequest $request): RedirectResponse
    {
        $book = new Book();

        //リクエストからパラメータ取得
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->admin_id = Auth::id();

        DB::transaction(function() use($book, $request)
        {
            // 保存
            $book->save();

            $book->authors()->attach($request->author_ids);
        });

        return redirect(route('book.index'))->with('message', $book->title . 'を追加しました。');
    }
}
