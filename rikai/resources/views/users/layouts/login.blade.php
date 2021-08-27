<!--login form popup-->
<div class="login-wrapper" id="login-content">
   <div class="login-content">
      <a href="#" class="close">x</a>
      <h3>{{__('message.LOG_In')}}</h3>
      <form method="post" action="{{ route("login") }}">
         @csrf
         <div class="row">
            <label for="email">
            {{__('message.Email')}}:
            <input type="email" name="email" id="email" placeholder="user@gmail.com"  required="required" />
            </label>
         </div>
         <div class="row">
            <label for="password">
            {{__('message.Password')}}:
            <input type="password" name="password" id="password" placeholder="******" required="required" />
            </label>
         </div>
         <div class="row">
            <div class="remember">
               <div>
                  <input type="checkbox" name="remember" value="Remember me"><span>{{__('message.Remember_me')}}</span>
               </div>
               <a href="#">{{__('message.Forget_password')}} ?</a>
            </div>
         </div>
         <div class="row">
            <button type="submit">{{__('message.LOG_In')}}</button>
         </div>
      </form>
      <div class="row">
         <p>{{__('message.Or_via_social')}}</p>
         <div class="social-btn-2">
            <a class="fb" href="{{ route('login.facebook', 'facebook') }}" 
      class="btn btn-secondary"><i class="ion-social-facebook"></i>Facebook</a>
            <a class="tw" href="{{ route('login.provider', 'google') }}" 
      class="btn btn-secondary"><i class="ion-social-google"></i>Google</a>
         </div>
      </div>
   </div>
</div>
<!--end of login form popup-->