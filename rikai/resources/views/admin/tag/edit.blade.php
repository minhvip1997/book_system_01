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
            <form class="forms-sample" method="post" action="{{route('tag.update',[$tag->id])}}">
               @method('PUT')
               <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="tagid" value="{{$tag->id}}">
                  <label for="exampleInputName1">{{__('message.Name_Category')}}</label>
                  <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="{{$tag->name}}" value="{{$tag->name}}">
               </div>
               <div class="form-group">
                  <label for="exampleTextarea1">{{__('message.Description')}}</label>
                  <input type="number" name="count" class="form-control" id="exampleInputName1" placeholder="{{$tag->count}}" value="{{$tag->count}}">
               </div>
               <button type="submit" class="btn btn-primary mr-2">{{__('message.submit')}}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection