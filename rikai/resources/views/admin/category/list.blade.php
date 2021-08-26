@extends('admin.layout.index')
@section('content1')
<div class="row">
   <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">{{__('message.Category_Book')}}</h4>
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr>
                        <th>{{__('message.Id')}}</th>
                        <th>{{__('message.Name_Category')}}</th>
                        <th>{{__('message.Parent_Category')}}</th>
                        <th>{{__('message.Action')}}</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($categories as $category)
                     <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->title}}</td>
                        <td>
                           @if(($category->parent_id != 0))
                              {{$category->parent()->value('title')}}
                           @else
                              {{__('message.None')}}
                           @endif
                        </td>
                        <td>
                           <a href="{{route('category.edit',[$category->id])}}">
                           <label class="badge badge-info">{{__('message.Edit')}}</label>
                           </a>
                           <a class="confirm" item-id="{{ $category->id }}" item-type="category" lang="{{ session('language') }}">
                              <label class="badge badge-danger">{{__('message.Delete')}}</label>
                           </a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection