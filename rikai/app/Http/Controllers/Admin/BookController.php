<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Book_category;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\BookRequest;
use App\Library\Services\Contracts\UploadimageServiceInterface; 
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    protected $uploadImageService;

    public function __construct(UploadImageServiceInterface $uploadImageServiceInterface)
    {
        $this->uploadImageService = $uploadImageServiceInterface;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::all();
        return view('admin.book.list',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorys = Category::where('parent_id','=','0')->get();
        return view('admin.book.add',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $type= 'book';
        $data['image'] = $this->uploadImageService->uploadImage($request,$data,$type);
        $book = Book::create($data);
        $categorys = $request->input('category_id');
        foreach($categorys as $category){
            DB::beginTransaction();
            try{
                $bookcategory = DB::table('book_category')->insert([
                    'book_id' => $book->id,
                    'category_id' => $category,
                ]);
                DB::commit();
            } catch(Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
        }
        if ($book){
            $message = 'message.add_book_success';
            return redirect()->route('bookadmin.index')->withMessage(__($message));
        } else {
            $message = 'message.add_book_fail';
            return redirect()->route('bookadmin.index')->withMessage(__($message));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($bookid)
    {
        //
        $book = $this->findBook($bookid);
        $category = Category::all();
        return view('admin.book.edit',compact('book','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $bookid)
    {
        //
        $book = $this->findBook($bookid);
        $data = $request->all();
        $categorybooks = Book_Category::where('book_id','=',$bookid)->get();
        $categorys = $request->input('category_id');
        $categoryvalue=[];
        foreach($categorybooks as $categorybook){
            $categoryvalue[] = $categorybook['category_id'];
        }
        foreach($categorys as $category){
            if(!in_array($category,$categoryvalue)){
                DB::beginTransaction();
                try{
                    $bookcategory = DB::table('book_category')->insert([
                        'book_id' => $book->id,
                        'category_id' => $category,
                    ]);
                    DB::commit();
                } catch(Exception $e){
                    DB::rollBack();
                    throw new Exception($e->getMessage());
                }
            }
        }
        foreach($categoryvalue as $value){
            if(!in_array($value,$categorys)){
                DB::beginTransaction();
                try{
                    $bookcategory = DB::table('book_category')->where([
                        ['book_id' ,'=', $bookid],
                        ['category_id', '=', $value]
                    ])->delete();
                    DB::commit();
                } catch(Exception $e){
                    DB::rollBack();
                    throw new Exception($e->getMessage());
                }
            }
        }
        $type = 'book';
        $data['image'] = $this->uploadImageService->uploadImage($request,$data,$type);
        $book->update($data);
        if($book){
            $message = 'message.update_book_success';
            return redirect()->route('bookadmin.edit',[$book->id])->withMessage(__($message));
        } else {
            $message = 'message.update_book_fail';
            return redirect()->route('bookadmin.edit',[$book->id])->withMessage(__($message));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bookid)
    {
        //
        $book = $this->findBook($bookid);
        $categories = Book_Category::where('book_id','=',$bookid)->get();
        $book->delete();
        foreach($categories as $category){
            DB::beginTransaction();
            try{
                $bookcategory = DB::table('book_category')->where([
                    ['book_id' ,'=', $bookid],
                    ['category_id', '=', $category->category_id]
                ])->delete();
                DB::commit();
            } catch(Exception $e){
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
        }
        $message = 'message.delete_book_success';
        return redirect()->route('bookadmin.index')->withMessage(__($message));
    }

    public function findBook($bookid){
        $book = Book::find($bookid);
        if($book){
            return $book;
        }else{
            $errors = 'message.no_book';
            return redirect()->route('homeadmin.index')->withErrors(__($errors));
        }
    }
}
