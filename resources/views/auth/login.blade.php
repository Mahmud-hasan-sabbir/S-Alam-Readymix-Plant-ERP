<x-guest-layout>

    <div class="row no-gutters">
        <div class="col-xl-12">
            <div class="auth-form">
                <x-jet-validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="text-center mb-3">
                    <div style="margin-left: -20px;margin-right: -20px;margin-top:-35px">
                        <a href="{{url('/')}}"><img src="{{asset('/public/images/s_alam.png')}}" style="width:75%" alt=""></a>
                    </div>
                </div><br>
                <h4 class="text-center mb-4" style="margin-top: -30px">Sign in your account</h4>
                <form method="POST" action="{{ route('login') }}" style="margin-top: -30px">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1"><strong>Email</strong></label>
                        <input type="email" name="email" id="email" placeholder="Email or Phone" class="form-control" :value="old('email')" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><strong>Password</strong></label>
                        <div style="position: relative;">
                            <input type="password" name="password" id="password" class="form-control pass-key" placeholder="Password" required autocomplete="current-password">
                            <span style="position: absolute;right: 10px;top: 10px;cursor: pointer;" class="show_password">SHOW</span>
                        </div>
                    </div>
                   
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                    </div>
                </form>
                {{-- <div class="new-account mt-3">
                        <p>Don't have an account? <a class="text-primary" href="{{ route('register') }}">Sign up</a></p>
                    </div> --}}
            </div>
        </div>
    </div>

</x-guest-layout>

<script>
    const pass_field = document.querySelector('.pass-key');
    const showBtn = document.querySelector('.show_password');
    showBtn.addEventListener('click', function(){
        if(pass_field.type === "password"){
            pass_field.type = "text";
            showBtn.textContent = "HIDE";
            showBtn.style.color = "#3498db";
        }else{
            pass_field.type = "password";
            showBtn.textContent = "SHOW";
            showBtn.style.color = "#222";
        }
    });
</script>
