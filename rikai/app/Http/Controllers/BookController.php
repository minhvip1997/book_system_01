<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use App\Models\Book_Category;
use App\Models\Category;
use App\Models\LikeReview;
use App\Models\User;
use App\Http\Requests\SearchFormRequest;
use App\Models\Activity;
use stdClass;
use App\Enums\FavoriteStatus;
use App\Enums\ReadStatus;
use App\Enums\ActivityType;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::paginate(12);
        return view('users.book.list',compact('books'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($bookId)
    {
        //
        $book = Book::find($bookId);
        if($book){
            $book_id = $book->id;
            $category_book = Book_Category::where('book_id','=',$book_id)->get();
            $categories = $book->categorys()->get();
            $bookrates = $book->rate;
            $data["activity"] = new stdClass;
            $this->activityController($data["activity"],$book_id);
            $reviews = Review::where('book_id','=',$book_id)->paginate(2);
            return view('users.book.detail',compact('book','reviews','categories','data','bookrates'));

        }else{
            $errors = 'message.no_book';
            return view('/')->withErrors(__($errors));
        }
    }

    public function search(Request $request){
        $name = $request->body;
        $books = Book::where('title','like','%'.$name.'%')
        ->orWhere('author','like','%'.$name.'%')->orwhere('rate','=',$name)->paginate(10);
        $total = count($books);
        return view('users.book.search',compact('books','total'));
    }


    private function activityController($data_activity,$book_id){
        if (auth()->user()) {
            $activity = Activity::where('user_id', auth()->user()->id)->where('book_id', $book_id)->latest('id')->first();
            if ($activity) {
                $data_activity->read_status = $activity->read_status;
                $data_activity->favorite_status = $activity->favorite_status;
            } else {
                $data_activity->read_status = ReadStatus::NONE;
                $data_activity->favorite_status = FavoriteStatus::NONE;
            }
        } else {
            $data_activity->read_status = ReadStatus::NONE;
            $data_activity->favorite_status = FavoriteStatus::NONE;
        }
    }

    public function addreview($bookId){
        $book = Book::find($bookId);
        return view('users.review.create',compact('book'));
    }

    public function fulltextsearch(Request $request){
        $books = Book::search($request->get('search'))->paginate(18);
        $total = count($books);
        return view('users.book.search',compact('books','total'));
    }
}
