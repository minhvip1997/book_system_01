<!--end of preloading-->
@include('users.layouts.login')
@include('users.layouts.register')
<!-- BEGIN | Header -->
<header class="ht-header">
   <div class="container">
      @include('users.layouts.menu')
      <!-- top search form -->
      @if ($errors->any())
      <div class="alert alert-danger display-error">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      @if (Session::has('message'))
      <div class="flash alert-info">
         <p class="panel-body display-message">
            {{ __(Session::get('message')) }}
         </p>
      </div>
      @endif
      <form method="get" id="searchForm" action="{{route('full.text.search')}}">
         <div class="top-search">
            <input type="text" name="body" placeholder="{{__('message.Search_for_a_book')}}">
            <button class="btn-search custom-btn-search">{{ __('message.search') }}</button>
         </div>
      </form>
   </div>
   <base href="{{asset('')}}">
   <link rel="stylesheet" href="css/plugins.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/custom.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</header>