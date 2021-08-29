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
                        <th>{{__('message.Name_Tag')}}</th>
                        <th>{{__('message.Tag_Search')}}</th>
                        <th>{{__('message.Action')}}</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($tags as $tag)
                     <tr>
                        <td>{{$tag->id}}</td>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->count}}</td>
                        <td>
                           <a href="{{route('tag.edit',[$tag->id])}}">
                           <label class="badge badge-info">{{__('message.Edit')}}</label>
                           </a>
                           <a class="confirm" item-id="{{ $tag->id }}" item-type="tag" lang="{{ session('language') }}">
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