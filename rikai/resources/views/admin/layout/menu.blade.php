<nav class="sidebar sidebar-offcanvas" id="sidebar">
   <ul class="nav">
      <li class="nav-item">
         <a class="nav-link" href="{{route('homeadmin.index')}}">
         <i class="icon-grid menu-icon"></i>
         <span class="menu-title">{{__('message.Home')}}</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
         <i class="icon-layout menu-icon"></i>
         <span class="menu-title">{{__('message.Category_Book')}}</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{route('category.index')}}">{{__('message.List_Category')}}</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{route('category.create')}}">{{__('message.Add_Category')}}</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
         <i class="icon-columns menu-icon"></i>
         <span class="menu-title">{{__('message.Books')}}</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"><a class="nav-link" href="{{route('bookadmin.index')}}">{{__('message.List_Book')}}</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('bookadmin.create')}}">{{__('message.Add_Book')}}</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
         <i class="icon-bar-graph menu-icon"></i>
         <span class="menu-title">{{__('message.Profiles')}}</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="charts">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"><a class="nav-link" href="{{route('profileadmin.index')}}">{{__('message.User_Profile')}}</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('profileadmin.edit',[auth()->user()->id])}}">{{__('message.Edit_Profile')}}</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
         <i class="icon-grid-2 menu-icon"></i>
         <span class="menu-title">{{__('message.Users')}}</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="tables">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}">{{__('message.List_User')}}</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('user.create')}}">{{__('message.Add_Users')}}</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
         <i class="icon-contract menu-icon"></i>
         <span class="menu-title">{{__('message.Manager_Checkout')}}</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="icons">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{route('cart.index')}}">{{__('message.List_Checkout')}}</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
         <i class="icon-contract menu-icon"></i>
         <span class="menu-title">{{__('message.Chart')}}</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="icons">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{route('chart.index')}}">{{__('message.statistics')}}</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
         <i class="icon-columns menu-icon"></i>
         <span class="menu-title">{{__('message.Tag')}}</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"><a class="nav-link" href="{{route('tag.index')}}">{{__('message.List_Tag')}}</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('tag.create')}}">{{__('message.Add_Tag')}}</a></li>
            </ul>
         </div>
      </li>
   </ul>
</nav>
