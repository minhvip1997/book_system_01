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
            <form class="forms-sample" method="POST" action="{{route('tag.store')}}">
               @method('POST')
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <div class="form-group">
                  <label for="exampleInputName1">{{__('message.Name_Tag')}}</label>
                  <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="{{__('message.Name_Category')}}">
               </div>
               <div class="form-group">
                  <label for="exampleTextarea1">{{__('message.Search')}}</label>
                  <input type="number" min="0" class="form-control" name="count" id="exampleInputName1" placeholder="{{__('message.Name_Category')}}">
               </div>
               <button type="submit" class="btn btn-primary mr-2">{{__('message.submit')}}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection