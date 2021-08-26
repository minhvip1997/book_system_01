@extends('admin.layout.index')
@section('content1')
<div class="row">
   <div class="col-12 grid-margin stretch-card">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">{{__('message.Add_Category')}}</h4>
            <p class="card-description">
               {{__('message.Add_Category')}}
            </p>
            <form class="forms-sample" method="POST" action="{{route('category.store')}}">
               @method('POST')
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <div class="form-group">
                  <label for="exampleInputName1">{{__('message.Name_Category')}}</label>
                  <input type="text" class="form-control" name="title" id="exampleInputName1" placeholder="{{__('message.Name_Category')}}">
               </div>
               <div class="form-group">
                  <label for="exampleTextarea1">{{__('message.Description')}}</label>
                  <textarea class="form-control" name="description" id="exampleTextarea1" rows="4"></textarea>
               </div>
               <div class="form-group">
                  <label for="exampleSelectGender">{{__('message.Parent_Category')}}</label>
                  <select class="form-control" name="parent_id" id="categorySelect2">
                  <option value="0">{{__('message.None')}}</option>
                     @if($categories)
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
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