@extends('admin.layout.index')
@section('content1')
<div class="row">
   <div class="col-12 grid-margin stretch-card">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">{{__('message.Edit_Category')}}</h4>
            <p class="card-description">
               {{__('message.Edit_Category')}}
            </p>
            <form class="forms-sample" method="post" action="{{route('category.update',[$category->id])}}">
               @method('PUT')
               <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="categoryid" value="{{$category->id}}">
                  <label for="exampleInputName1">{{__('message.Name_Category')}}</label>
                  <input type="text" name="title" class="form-control" id="exampleInputName1" placeholder="{{$category->title}}" value="{{$category->title}}">
               </div>
               <div class="form-group">
                  <label for="exampleTextarea1">{{__('message.Description')}}</label>
                  <textarea class="form-control" name="description" placeholder="{{$category->description}}" id="exampleTextarea1" rows="4">{{$category->description}}</textarea>
               </div>
               <div class="form-group">
                  <label for="exampleSelectGender">{{__('message.Parent_Category')}}</label>
                  <select class="form-control" name="parent_id" id="categorySelect2">
                  <option value="0">{{__('message.None')}}</option>
                  @if($categories)
                     @foreach($categories as $item)
                        <option value="{{$item->id}}" @if($category->parent_id == $item->id ) selected @endif>{{$item->title}}</option>
                     @endforeach
                  @endif
                  </select>
               </div>
               <button type="submit" class="btn btn-primary mr-2">{{__('message.submit')}}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection