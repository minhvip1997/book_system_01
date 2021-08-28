<?php
use App\Models\Category;
 function rateform(){
    $count = 11;
    for($i=1;$i<$count;$i++){
      $input1 ='<input type="radio" name="rate" id="rate-'.$i.'" value="'.$count-$i.'">';
      $input2 ='<label for="rate-'.$i.'" class="fas fa-star"></label>';
      echo $input1."".$input2;
    }
 }
 function oldrate($rate){
   for($i=10;$i>= 1; $i--){
      if($rate>= $i){
         echo $input1 = '<label for="rate-'.$i.'" class="fas fa-star" style="color:#fd4"></label>';
      }
      else{
         echo $input2 = '<label for="rate-'.$i.'" class="fas fa-star"></label>';
      }
   }
 }
 function like($review){
   if(Auth::user()->isLikeReviews($review)){
      echo __('message.is_like_review');
   }else{
      echo __('message.Like');
   }
 }

 function comment($comment){
   if(Auth::user()->isLikeComments($comment)){
      echo __('message.is_like_comment');
   }else{
      echo __('message.Comments');
   }
 }


 function follow($user){
   if(Auth::user()->isFollowing($user)){
      return __('message.Followed');
   }else{
      return __('message.Follow');
   }
 }

 function categorybook(){
   $categorys = DB::table('category')->get();
   foreach($categorys as $category){
   echo '<li><a href="'.route('categoryuser.edit',[$category->id]).'">'.__('message.'.$category->title).'</a></li>';

   }
 }

 function allCategorybook(){
   $categorys = Category::where('parent_id','=','0')->get();

   foreach($categorys as $category){
      echo  '<li class="dropdown">';
      echo '<a href="'.route('categoryuser.edit',[$category->id]).'">'.__('message.'.$category->title).'<span class="expand">&raquo;</span>'.'</a>';
      echo  '<ul class="child">';
         foreach($category->subcategory()->get() as $cat){
            echo  '<li class="dropdown">';
            echo  '<a href="'.route('categoryuser.edit',[$cat->id]).'" nowrap>'.__('message.'.$cat->title).'</a><br>';
            echo  '</li>';
         }
      echo  '</ul>';
      echo  '</li>';
   }
 }

 function checkreviewhide($review){
   if($review->approve == 1){
      echo "checked";
   }
 }

 function checkcommenthide($comment){
   if($comment->approve == 1){
      echo "checked";
   }
 }
?>