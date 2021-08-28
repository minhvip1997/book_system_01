<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use App\Models\LikeReview;
use App\Models\Comment;
use App\Models\Book_Category;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\ReviewFormRequest;
use App\Jobs\NewReviewJob;
use Illuminate\Support\Facades\Auth;
use Session;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('users.review.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.review.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewFormRequest $request)
    {
        //
        $data = $request->all();
        $data['book_id'] = $request->bookid;
        $data['user_id'] = $request->user()->id;
        $review = Review::create($data);
        $this->updateRate($data['book_id']);
        if ($review){
            dispatch(new NewReviewJob($review));
            $message = 'message.add_review_success';
            return redirect()->route('book.show',[$review->book_id])->withMessage(__($message));
        } else {
            $message = 'message.add_review_sfail';
            return redirect()->route('book.show',[$review->book_id])->withMessage(__($message));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($reviewId)
    {
        //
        $review = Review::where('id','=',$reviewId)->first();
        $id = Auth::user()->id;
        $currentuser = User::find($id);
        if ($review){
            $book = Book::find($review->book_id);
            $book_id = $book->id;
            $category_book = Book_Category::where('book_id','=',$book_id)->first();
            $categories = $book->categorys()->get();
            $comments = Comment::where('review_id','=',$reviewId)->get();
            $totalcomment = Comment::where('review_id','=',$reviewId)->count();
            return view('users.review.show',compact('review','book','comments','categories','totalcomment','currentuser'));
        } else {
            $errors = 'message.sufficient_permissions';
            return redirect()->route('index')->withErrors(__($errors));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $reviewId)
    {
        //
        $review = Review::find($reviewId);
        $book_id = $review->book_id;
        $book = Book::find($book_id);
        if ($review && $this->hasreview($review)==true){
            return view('users.review.edit',compact('review','book'));
        } else {
            $errors = 'message.sufficient_permissions';
            return redirect()->route('index')->withErrors(__($errors));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewFormRequest $request, $reviewId)
    {
        //
        $review = Review::find($reviewId);

        if ($review && $this->hasreview($review)==true){
            $rate = $request->rate;
            $data = $request->all();
        if ($rate != null){
            $data['rate'] = $rate;
        } else {
            $data['rate'] = $review->rate;
        }
            $message = 'message.update_review_success';
            $review->update($data);
            $this->updateRate($review->book_id);
            return redirect()->route('book.show',[$review->book_id])->withMessage(__($message));
        } else {
            $errors = 'message.sufficient_permissions';
            return redirect()->route('index')->withErrors(__($errors));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$reviewId)
    {
        //
        $review = Review::find($reviewId);
        if ($review && $this->hasreview($review)==true){
            $review->delete();
            $this->updateRate($review->book_id);
            $message = 'message.delete_review_success';
            return redirect()->route('book.show',[$review->book_id])->withMessage(__($message));
        } else {
            $errors = 'message.sufficient_permissions';
            return redirect()->route('index')->withErrors(__($errors));
        }
    }


    public function hasreview(Review $review){
        $result = false;
        if ($review->user_id == Auth::user()->id || Auth::user()->role=='admin'){
            $result = true;
        }
        return $result;
    }
    
    public function likereview(Request $request, $reviewId){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $like_review = LikeReview::where(['user_id'=>$data['user_id'],'review_id'=>$reviewId])->first();
        $review = Review::find($reviewId);
        $book = Book::where('id','=',$review->book_id)->first(); 
        if (empty($like_review->user_id)){
            $data['review_id'] = $reviewId;
            $data['like'] = 1;
            $like_review = LikeReview::firstOrCreate($data);
            $like_review->save();
            return redirect()->route('book.show',[$book->id]);
        } else {
            $errors = 'message.is_like_review';
            return redirect()->route('book.show',[$book->id])->withErrors(__($errors));
        }
    }

    public function unlikereview(Request $request, $reviewId){
        $user_id = Auth::user()->id;
        $like_review = LikeReview::where(['user_id'=>$user_id,'review_id'=>$reviewId])->first();
        $review = Review::find($reviewId);
        $book = Book::where('id','=',$review->book_id)->first(); 
        if ($like_review){
            $like_review->delete();
            return redirect()->route('book.show',[$book->id]);
        } else {
            $errors = 'message.no_like';
            return redirect()->route('book.show',[$book->id])->withErrors(__($errors));
        }
    }

    private function updateRate($bookid){
        $book = Book::find($bookid);
        $bookreviews = $book->reviews()->avg('rate');
        $book->rate = $bookreviews;
        $book->update();
    }

    public function hidereview(Request $request,$reviewId){
        $review = Review::find($reviewId);
        if($review){
            $approveval = $request->approveval;
            if($approveval =='on'){
                $approveval = 1;
                $message = 'message.hide_review_success';

            }else{
                $approveval = 0;
                $message = 'message.show_review_success';
            }
            $review->approve = $approveval;
            $review->update();
            return redirect()->route('book.show',[$review->book_id])->withMessage(__($message));
        }else{
            $errors = 'message.sufficient_permissions';
            return redirect()->route('book.show',[$review->book_id])->withErrors(__($errors));
        }
    }
}
