@extends('users.layouts.index')
@section('content')
@include('users.layouts.slide')
<div class="movie-items">
   <div class="container">
      <div class="row ipad-width">
         <div class="col-md-8">
            <div class="title-hd">
               <h2>{{__('in_library')}}</h2>
               <a href="{{ route('book.index') }}" class="viewall">{{__('message.View_all')}} <i class="ion-ios-arrow-right"></i></a>
            </div>
            <div class="tabs">
               <ul class="tab-links">
                  <li class="active"><a href="#tab1">{{__('message.#Popular')}}</a></li>
                  <li><a href="#tab2"> {{__('message.#Coming_soon')}}</a></li>
                  <li><a href="#tab3">  {{__('message.#Top_rated')}}  </a></li>
                  <li><a href="#tab4"> {{__('message.#Most_reviewed')}}</a></li>
               </ul>
               <div class="tab-content">
                  <div id="tab1" class="tab active">
                     <div class="row">
                        <div class="slick-multiItem">
                           @foreach($books as $book)
                           <div class="slide-it">
                              <div class="movie-item">
                                 <div class="mv-img">
                                    <img src="{{asset('/upload/book/'.$book->image)}}" class="output_image" alt="" >
                                 </div>
                                 <div class="hvr-inner">
                                    <a  href="{{url('book/'.$book->id)}}"> {{__('message.Read_more')}} <i class="ion-android-arrow-dropright"></i> </a>
                                 </div>
                                 <div class="title-in">
                                    <h6><a href="{{url('book/'.$book->id)}}">{{$book->title}}</a></h6>
                                    <p><i class="ion-android-star"></i><span>{{$book->rate?$book->rate:0}}</span> /10</p>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
                  <div id="tab2" class="tab">
                     <div class="row">
                        <div class="slick-multiItem">
                        @foreach($books as $book)
                           <div class="slide-it">
                              <div class="movie-item">
                                 <div class="mv-img">
                                    <img src="{{asset('/upload/book/'.$book->image)}}" class="output_image" alt="" >
                                 </div>
                                 <div class="hvr-inner">
                                    <a  href="{{url('book/'.$book->id)}}"> {{__('message.Read_more')}} <i class="ion-android-arrow-dropright"></i> </a>
                                 </div>
                                 <div class="title-in">
                                    <h6><a href="{{url('book/'.$book->id)}}">{{$book->title}}</a></h6>
                                    <p><i class="ion-android-star"></i><span>{{$book->rate?$book->rate:0}}</span> /10</p>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
                  <div id="tab3" class="tab">
                     <div class="row">
                        <div class="slick-multiItem">
                        @foreach($books as $book)
                           <div class="slide-it">
                              <div class="movie-item">
                                 <div class="mv-img">
                                    <img src="{{asset('/upload/book/'.$book->image)}}" class="output_image" alt="" >
                                 </div>
                                 <div class="hvr-inner">
                                    <a  href="{{url('book/'.$book->id)}}"> {{__('message.Read_more')}} <i class="ion-android-arrow-dropright"></i> </a>
                                 </div>
                                 <div class="title-in">
                                    <h6><a href="{{url('book/'.$book->id)}}">{{$book->title}}</a></h6>
                                    <p><i class="ion-android-star"></i><span>{{$book->rate?$book->rate:0}}</span> /10</p>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
                  <div id="tab4" class="tab">
                     <div class="row">
                        <div class="slick-multiItem">
                        @foreach($books as $book)
                           <div class="slide-it">
                              <div class="movie-item">
                                 <div class="mv-img">
                                    <img src="{{asset('/upload/book/'.$book->image)}}" class="output_image" alt="" >
                                 </div>
                                 <div class="hvr-inner">
                                    <a  href="{{url('book/'.$book->id)}}"> {{__('message.Read_more')}} <i class="ion-android-arrow-dropright"></i> </a>
                                 </div>
                                 <div class="title-in">
                                    <h6><a href="{{url('book/'.$book->id)}}">{{$book->title}}</a></h6>
                                    <p><i class="ion-android-star"></i><span>{{$book->rate?$book->rate:0}}</span> /10</p>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @foreach ($categorys as $category)
                <div class="title-hd">
                  <h2>{{ $category->title }}</h2>
                  <a href="{{ route('categoryuser.edit',[$category->id]) }}" class="viewall">{{__('message.View_all')}} <i class="ion-ios-arrow-right"></i></a>
               </div>
               <div class="tabs">
                  <ul class="tab-links-2">
                     <li><a href="#tab21">{{__('message.#Popular')}}</a></li>
                     <li class="active"><a href="#tab22"> {{__('message.#Coming_soon')}}</a></li>
                     <li><a href="#tab23">  {{__('message.#Top_rated')}}  </a></li>
                     <li><a href="#tab24"> {{__('message.#Most_reviewed')}}</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab21" class="tab">
                        <div class="row">
                           <div class="slick-multiItem">
                           @foreach($category->books as $book)
                              <div class="slide-it">
                                 <div class="movie-item">
                                    <div class="mv-img">
                                       <img src="{{asset('/upload/book/'.$book->image)}}" class="output_image" alt="" >
                                    </div>
                                    <div class="hvr-inner">
                                       <a  href="{{url('book/'.$book->id)}}"> {{__('message.Read_more')}} <i class="ion-android-arrow-dropright"></i> </a>
                                    </div>
                                    <div class="title-in">
                                       <h6><a href="{{url('book/'.$book->id)}}">{{$book->title}}</a></h6>
                                       <p><i class="ion-android-star"></i><span>{{$book->rate?$book->rate:0}}</span> /10</p>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     <div id="tab22" class="tab active">
                        <div class="row">
                           <div class="slick-multiItem">
                           @foreach($category->books as $book)
                              <div class="slide-it">
                                 <div class="movie-item">
                                    <div class="mv-img">
                                       <img src="{{asset('/upload/book/'.$book->image)}}" class="output_image" alt="" >
                                    </div>
                                    <div class="hvr-inner">
                                       <a  href="{{url('book/'.$book->id)}}"> {{__('message.Read_more')}} <i class="ion-android-arrow-dropright"></i> </a>
                                    </div>
                                    <div class="title-in">
                                       <h6><a href="{{url('book/'.$book->id)}}">{{$book->title}}</a></h6>
                                       <p><i class="ion-android-star"></i><span>{{$book->rate?$book->rate:0}}</span> /10</p>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     <div id="tab23" class="tab">
                        <div class="row">
                           <div class="slick-multiItem">
                           @foreach($category->books as $book)
                              <div class="slide-it">
                                 <div class="movie-item">
                                    <div class="mv-img">
                                       <img src="{{asset('/upload/book/'.$book->image)}}" class="output_image" alt="" >
                                    </div>
                                    <div class="hvr-inner">
                                       <a  href="{{url('book/'.$book->id)}}"> {{__('message.Read_more')}} <i class="ion-android-arrow-dropright"></i> </a>
                                    </div>
                                    <div class="title-in">
                                       <h6><a href="{{url('book/'.$book->id)}}">{{$book->title}}</a></h6>
                                       <p><i class="ion-android-star"></i><span>{{$book->rate?$book->rate:0}}</span> /10</p>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     <div id="tab24" class="tab">
                        <div class="row">
                           <div class="slick-multiItem">
                           @foreach($category->books as $book)
                              <div class="slide-it">
                                 <div class="movie-item">
                                    <div class="mv-img">
                                       <img src="{{asset('/upload/book/'.$book->image)}}" class="output_image" alt="" >
                                    </div>
                                    <div class="hvr-inner">
                                       <a  href="{{url('book/'.$book->id)}}"> {{__('message.Read_more')}} <i class="ion-android-arrow-dropright"></i> </a>
                                    </div>
                                    <div class="title-in">
                                       <h6><a href="{{url('book/'.$book->id)}}">{{$book->title}}</a></h6>
                                       <p><i class="ion-android-star"></i><span>{{$book->rate?$book->rate:0}}</span> /10</p>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
            @endforeach
         </div>
         <div class="col-md-4">
            <div class="sidebar">
               <div class="ads">
                  <img src="images/uploads/ads1.png" alt="" width="336" height="296">
               </div>
               <div class="celebrities">
                  <h4 class="sb-title">{{__('message.Users')}}</h4>
                  @foreach ($users as $item)
                  <div class="celeb-item">
                     <a href="{{ url('profile/'.$item->id) }}"><img src="{{ imgSrc($item->image) }}" class="small-user-image" width="70" height="70"></a>
                     <div class="celeb-author">
                        <h6><a href="{{ url('profile/'.$item->id) }}">{{ $item->name }}</a></h6>
                        <span>{{ $item->email }}</span>
                     </div>
                  </div>
                  @endforeach                  
                  <a href="{{ route('listuser') }}" class="btn">{{__('message.List_User')}}<i class="ion-ios-arrow-right"></i></a>
               </div>
               <div class="celebrities">
                  <h4 class="sb-title">{{__('message.Tag')}}</h4>
                  @foreach ($tags as $tag)
                  <div class="celeb-item">
                     <h6><a href="{{ route('search.tag',[$tag->id]) }}">{{ $tag->name }}</a></h6>
                  </div>
                  @endforeach                  
                  <a href="{{ route('listuser') }}" class="btn">{{__('message.List_User')}}<i class="ion-ios-arrow-right"></i></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection