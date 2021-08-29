@extends('admin.layout.index')
@section('content1')
<div class="row">
   <div class="col-12 grid-margin stretch-card">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">{{__('message.Books')}}</h4>
            <p class="card-description">
               {{__('message.Books')}}
            </p>
            <form class="forms-sample" method="post" action="{{route('bookadmin.update',[$book->id])}}" enctype="multipart/form-data">
               @method('PUT')
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="bookid" value="{{ $book->id }}">
               <div class="form-group">
                  <label for="exampleInputEmail3">{{__('message.Title')}}</label>
                  <input type="text" class="form-control" name="title" id="exampleInputEmail3" placeholder="{{__('message.Title')}}" value="{{$book->title}}">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword4">{{__('message.Author')}}</label>
                  <input type="text" class="form-control" name="author" id="exampleInputPassword4" placeholder="{{__('message.Author')}}" value="{{$book->author}}">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword4">{{__('message.publish_at')}}</label>
                  <input type="date" name="publish_at" class="form-control" id="exampleInputPassword4" placeholder="{{__('message.Author')}}" value="{{$book->publish_at}}">
               </div>
               <div class="form-group">
                  <label for="exampleSelectGender">{{__('message.Name_Category')}}</label>
                  <select class="form-control"  name="category_id[]" id="categorySelect2">
                  @foreach($category as $tl)
                     <option
                     @foreach($book->categorys as $category)
                        @if($category->id == $tl->id)
                           {{"selected"}}
                        @endif
                     @endforeach
                     value="{{$tl->id}}">{{$tl->title}}</option>
                  @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label for="exampleSelectGender">{{__('message.Name_Category')}}</label>
                  <select class="form-control"  name="tag_id[]" id="categorySelect2" multiple>
                  @foreach($tag as $tagchoose)
                     <option
                     @foreach($book->bookTag as $value)
                        @if($value->tag_id == $tagchoose->id)
                           {{"selected"}}
                        @endif
                     @endforeach
                     value="{{$tagchoose->id}}">{{$tagchoose->name}}</option>
                  @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>{{__('message.Image')}}</label>
                  <input type="file" name="image" class="file-upload-default">
                  <div class="input-group col-xs-12">
                     <input type="text" class="form-control file-upload-info" disabled placeholder="{{__('message.Upload')}}">
                     <span class="input-group-append">
                     <button class="file-upload-browse btn btn-primary" type="button">{{__('message.Upload')}}</button>
                     </span>
                  </div>
               </div>
               <div class="form-group">
                  <label for="exampleInputCity1">{{__('message.Image')}}</label>
                  <img src="upload/book/{{$book->image}}" width="400px">
               </div>
               <div class="form-group">
                  <label for="exampleInputCity1">{{__('message.number_of_page')}}</label>
                  <input type="text" name="num_of_page" class="form-control" id="exampleInputCity1" placeholder="{{__('message.number_of_page')}}" value="{{$book->num_of_page}}">
               </div>
               <div class="form-group">
                  <label for="exampleInputCity1">{{__('message.Quantity')}}</label>
                  <input type="text" name="quantity" class="form-control" id="exampleInputCity1" placeholder="{{__('message.Quantity')}}" value="{{$book->quantity}}">
               </div>
               <div class="form-group">
                  <label for="exampleInputCity1">{{__('message.price')}}</label>
                  <input type="text" name="price" class="form-control" id="exampleInputCity1" placeholder="{{__('message.price')}}" value="{{$book->price}}">
               </div>
               <button type="submit" class="btn btn-primary mr-2">{{__('message.submit')}}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection