<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use App\Models\User;
use App\Models\Comment;
use App\Models\LikeComment;
use App\Http\Requests\CommentFormRequest;
use App\Jobs\NewCommentJob;
use Illuminate\Support\Facades\Auth;
use App\Models\Book_Category;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentFormRequest $request)
    {
        //
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['review_id'] = $request->reviewid;
        $comment = Comment::create($data);
        if ($comment){
            dispatch(new NewCommentJob($comment));
            $message = 'message.add_comment_success';
            return redirect()->route('review.show',[$request->reviewid])->withMessage(__($message));
        } else {
            $message = 'message.add_comment_fail';
            return redirect()->route('review.show'.[$request->reviewid])->withMessage(__($message));  
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
    public function edit($commentid)
    {
        //
        $comment = Comment::find($commentid);
        if ($comment && $this->hascomment($comment)==true){
            return view('users.comment.edit',compact('comment'));
        } else {
            $errors = 'message.sufficient_permissions';
            return redirect()->route('review.show',[$comment->review_id])->withErrors(__($errors));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentFormRequest $request, $commentid)
    {
        //
        $comment = Comment::find($commentid);
        if ($comment && $this->hascomment($comment)==true){
            $data = $request->all();
            $comment->update($data);
            if ($comment){
                $message = 'message.update_comment_success';
                return redirect()->route('review.show',[$comment->review_id])->withMessage(__($message));
            } else {
                $message = 'message.update_comment_fail';
                return redirect()->route('review.show',[$comment->review_id])->withMessage(__($message));
            }
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
    public function destroy($commentId)
    {
        //
        $comment = Comment::find($commentId);
        if ($comment && $this->hascomment($comment)==true ){
            $comment->delete();
            $message = 'message.delete_comment_success';
            return back()->withMessage(__($message));
        } else {
            $errors = 'message.sufficient_permissions';
            return redirect()->route('index')->withErrors(__($errors));
        }
    }

    public function hascomment(Comment $comment){
        $result = false;
        if ($comment->user_id == Auth::user()->id || Auth::user()->role=='admin'){
            $result = true;
        }
        return $result;
    }

    public function likecomment(Request $request, $commentId){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $like_comment = LikeComment::where(['user_id'=>$data['user_id'],'comment_id'=>$commentId])->first();
        $comment= Comment::find($commentId);
        $review = Review::where('id','=',$comment->review_id)->first(); 
        if(empty($like_comment->user_id)){

            $data['comment_id'] = $commentId;
            $data['like'] = 1;
            $like_review = LikeComment::firstOrCreate($data);
            $like_review->save();
            return redirect()->route('review.show',[$review->id]);
        }else{
            $errors = 'message.is_like_comment';
            return redirect()->route('review.show',[$review->id])->withErrors(__($errors));

        }
    }
    public function unlikecomment(Request $request, $commentId){
        $user_id = Auth::user()->id;
        $like_comment = LikeComment::where(['user_id'=>$user_id,'comment_id'=>$commentId])->first();
        $comment= Comment::find($commentId);
        $review = Review::where('id','=',$comment->review_id)->first(); 
        if($like_comment){
            $like_comment->delete();
            return redirect()->back();
        }else{
            $errors = 'message.no_like';
            return redirect()->route('review.show',[$review->id])->withErrors(__($errors));
        }
    }

    public function managercomment($reviewId){
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
            return view('users.comment.manager',compact('review','book','comments','categories','totalcomment','currentuser'));
        } else {
            $errors = 'message.sufficient_permissions';
            return redirect()->route('index')->withErrors(__($errors));
        }
    }

    public function hidecomment(Request $request,$commentId){
        $comment = Comment::find($commentId);
        if($comment){
            $approveval = $request->approveval;
            if($approveval =='on'){
                $approveval = 1;
                $message = 'message.hide_comment_success';

            }else{
                $approveval = 0;
                $message = 'message.show_comment_success';
            }
            $comment->approve = $approveval;
            $comment->update();
            return redirect()->route('review.show',[$comment->review_id])->withMessage(__($message));
        }else{
            $errors = 'message.sufficient_permissions';
            return redirect()->route('index')->withErrors(__($errors));
        }
    }
}
