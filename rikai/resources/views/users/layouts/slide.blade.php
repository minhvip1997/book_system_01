<div class="slider movie-items">
   <div class="container">
      <div class="row">
         <div class="social-link">
            <p>{{__('message.Follow_us')}} </p>
            <a href="#"><i class="ion-social-facebook"></i></a>
            <a href="#"><i class="ion-social-twitter"></i></a>
            <a href="#"><i class="ion-social-googleplus"></i></a>
            <a href="#"><i class="ion-social-youtube"></i></a>
         </div>
         <div  class="slick-multiItemSlider">
            @foreach ($slides as $item)
            <div class="movie-item">
               <div class="mv-img">
                  <a href="#"><img src="{{ asset('/upload/book/'.$item->image) }}" alt="" class="custom-slides-image" width="285" height="437"></a>
               </div>
               <div class="title-in">
                  <div class="cate">
                     <span class="blue"><a href="#">{{__('message.'.$item->categorys()->value('title'))}}</a></span>
                  </div>
                  <h6><a href="{{url('book/'.$item->id)}}">{{ $item->title }}</a></h6>
                  <p><i class="ion-android-star"></i><span>{{$item->rate}}</span> /10</p>
               </div>
            </div>
            @endforeach            
         </div>
      </div>
   </div>
</div>