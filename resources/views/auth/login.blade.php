@extends('../auth')

@section('konten')
<main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                    @if(session('success'))
                    <div class="card bg-gradient-success my-2">
                        <div class="card-body">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    @if(session('failed'))
                    <div class="card bg-gradient-danger my-2">
                        <div class="card-body text-light">
                            {{ session('failed') }}
                        </div>
                    </div>
                    @endif
                  <h4 class="font-weight-bolder">Masuk</h4>
                  <p class="mb-0">Silahkan masukkan Email dan Kata Sandi</p>
                </div>
                <div class="card-body">
                  <form role="form" method="post">
                    @csrf
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                      @error('email')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Kata Sandi" aria-label="Password">
                      @error('password')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn-persadia btn btn-lg w-100 mt-4 mb-0" style="background: linear-gradient(96.98deg, #2DDB2C 8.81%, #178917 110.54%) !important;" onmouseover="this.style.background = 'linear-gradient(96.98deg, #FFF 8.81%, gray 110.54%)'" onmouseout="this.style.background = 'linear-gradient(96.98deg, #2DDB2C 8.81%, #178917 110.54%)'">Masuk</button>
                    </div>
                  </form>
                </div>
                {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div> --}}
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-persadia opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</main>
@endsection