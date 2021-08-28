@extends('users.layouts.index')
@section('content')
@include('users.title.review.header')
<h1> {{__('message.Show_Review')}}</h1>
@include('users.title.body')
<li> <span class="ion-ios-arrow-right"></span> {{__('message.Show_Review')}}</li>
@include('users.title.footer')
<div class="page-single">
   <div class="container">
      <div class="row ipad-width">
         <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
               <div class="blog-detail-ct">
                  <h1>{{$review->title}}</h1>
                  <span class="time">{{$review->created_at}}</span>
                  <div class="flex-it flex-ct">
                     <p>
                        {{$review->body}}
                     </p>
                  </div>
                  <!-- share link -->
                  <div class="flex-it share-tag">
                     <div class="social-link">
                        <h4>{{__('message.Share_it')}}</h4>
                        <a href="#"><i class="ion-social-facebook"></i></a>
                        <a href="#"><i class="ion-social-twitter"></i></a>
                        <a href="#"><i class="ion-social-googleplus"></i></a>
                        <a href="#"><i class="ion-social-pinterest"></i></a>
                        <a href="#"><i class="ion-social-linkedin"></i></a>
                     </div>
                     @if(!Auth::guest())
                     <ul class="nav nav-pills">
                        <li role="presentation">
                           <a href="{{route('like.review',[$review->id])}}" class="like">{{__('message.Like')}}:
                           {{$review->likeReviews()->count()}}
                           <span class="fa fa-thumbs-up"></span>
                           </a>
                        </li>
                        <li role="presentation">
                           <a href="{{route('unlike.review',[$review->id])}}" class="like">{{__('message.Unlike')}}:
                           <span class="fa fa-thumbs-down"></span>
                           </a>
                        </li>
                     </ul>
                     @endif
                     <div class="right-it">
                        <h4>{{__('message.Tags')}}</h4>
                        @foreach($categories as $category)
                        <a href="#">{{__("message.$category->title")}} , </a>
                        @endforeach
                     </div>
                  </div>
                  <!-- comment items -->
                  <div class="comments">
                     <h4>{{$totalcomment}} {{__('message.Comments')}}</h4>
                     @foreach($comments as $comment)
                     <div class="cmt-item flex-it">
                        <div class="author-infor width-100">
                           <div class="flex-it2">
                              <div>
                                 <h6><a href="#">
                                    {{$comment->user()->value('name')}}
                                    </a>
                                 </h6>
                                 <span class="time"> {{$comment->created_at}}</span>
                              </div>
                              <div class="left-half">
                                 @if(Auth::user()->role=='admin')
                                 <form action="{{route('comment.hide',[$comment->id])}}" class="hidereview" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input {{checkcommenthide($review)}} type="checkbox" name="approveval">
                                    <input type="hidden" name="commentId" value="{{ $comment->id }}">
                                    <input class="btn btn-primary" type="submit" value="{{__('message.hidecomment')}}">
                                 </form>
                                 @endif
                              </div>
                           </div>
                           <p>{{$comment->body}}</p>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  <!-- comment form -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection