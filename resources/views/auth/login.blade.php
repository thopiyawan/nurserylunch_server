@extends('layouts.app')

@section('content')
<div class="row" id="login-wrapper">
    <div class="col-md-6 login-panel left">
        <img src="{{ asset('images/login-img.png') }}" class="animate__animated animate__fadeInDown login-image">
        
        <div class="animate__animated animate__fadeInRight login-desc"> 
            ผู้ช่วยระดับโภชนาการในการาแนะนำอาหารกลางวันเด็กเล็กแบบอัตโนมัติ
        </div>
        <div class="animate__animated animate__fadeInLeft login-title">
            THAI NURSERY LUNCH
        </div>
    </div>
    <div class="col-md-6 login-panel right">
        <h3 class="font-normal text-highlight">เข้าสู่ระบบ</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
<!--             <div class="form-group">
                <label class="control-label font-light" for="username">ชื่อผู้ใช้งาน</label>
                <input type="text"  title="กรุณาใส่ชื่อผู้ใช้งาน" placeholder="ชื่อผู้ใช้งาน" required="" value="" name="username" id="username" class="form-control font-light">
            </div> -->
            <div class="form-group">
                <label class="control-label">{{ __('ชื่อผู้ใช้งาน') }}</label>
                <input id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>"ชื่อผู้ใช้งานไม่ถูกต้อง"</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="control-label">{{ __('รหัสผ่าน') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $รหัสผ่านไม่ถูกต้อง }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')?'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <a class="link text-highlight" href="https://recovery.thaischoollunch.in.th/">
                        {{ __('ลืมรหัสผ่าน?') }}
                    </a>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('เข้าสู่ระบบ') }}
                </button>
            </div>
        </form>
        <div class="hr-line-dashed"></div>
        <div>
            <p class="text-center">ยังไม่มีบัญชีผู้ใช้งาน?</p>
            <a class="btn btn-default btn-block" href="https://school.kiddiary.in.th/registers" target="_blank">สร้างบัญชีใหม่</a>
        </div>
    </div>
</div>
@endsection
