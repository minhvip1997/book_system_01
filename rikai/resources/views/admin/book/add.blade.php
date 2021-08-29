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
            <form class="forms-sample" method="POST" action="{{route('bookadmin.store')}}" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="exampleInputEmail3">{{__('message.Title')}}</label>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="text" name="title" class="form-control" id="exampleInputEmail3" placeholder="{{__('message.Title')}}">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword4">{{__('message.Author')}}</label>
                  <input type="text" name="author" class="form-control" id="exampleInputPassword4" placeholder="{{__('message.Author')}}">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword4">{{__('message.publish_at')}}</label>
                  <input type="date" name="publish_at" class="form-control" id="exampleInputPassword4" placeholder="{{__('message.Author')}}">
               </div>
               <div class="form-group">
                  <label for="exampleSelectGender">{{__('message.Name_Category')}}</label>
                  <select class="form-control" name="category_id[]" id="categorySelect2">
                     @foreach($categorys as $category)
                     <optgroup label="{{$category->title}}">
                        @foreach($category->subcategory()->get() as $cat)
                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                        @endforeach
                     </optgroup>
                     <!-- <option value="{{$category->id}}">{{$category->title}}</option> -->
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label for="exampleSelectGender">{{__('message.Name_Category')}}</label>
                  <select class="form-control" name="tag_id[]" id="categorySelect2" multiple>
                     @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
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
                  <label for="exampleInputCity1">{{__('message.number_of_page')}}</label>
                  <input type="text" class="form-control" name="num_of_page" id="exampleInputCity1" placeholder="{{__('message.number_of_page')}}">
               </div>
               <div class="form-group">
                  <label for="exampleInputCity1">{{__('message.Quantity')}}</label>
                  <input type="text" class="form-control" id="exampleInputCity1" name="quantity" placeholder="{{__('message.Quantity')}}">
               </div>
               <div class="form-group">
                  <label for="exampleInputCity1">{{__('message.price')}}</label>
                  <input type="text" class="form-control" id="exampleInputCity1" name="price" placeholder="{{__('message.price')}}">
               </div>
               <button type="submit" class="btn btn-primary mr-2">{{__('message.submit')}}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection