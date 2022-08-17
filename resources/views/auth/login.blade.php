<x-guest-layout>
    <section class="" style="background-color: #9A616D;">
        <div class="container py-5">
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-xl-11">
              <div class="card mb-5" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-4 d-none d-md-block">
                    <img src="{{ asset('assets/images/darkmineral.jpg') }}"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  <div class="col-md-8 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
                        <x-auth-validation-errors class="alert alert-danger" role="alert" :errors="$errors" />

                      <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                          <span class="h1 fw-bold mb-0">Mineral Claim & Market Hub</span>
                        </div>

                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                        <div class="form-outline mb-4">
                          <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" required/>
                          <label class="form-label" for="form2Example17">Email address</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" required/>
                          <label class="form-label" for="form2Example27">Password</label>
                        </div>

                        <div class="pt-1 mb-4">
                          <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                        </div>

                        <a class="small text-muted" href="#!">Forgot password?</a>
                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="{{ route('register') }}"
                            style="color: #393f81;">Register here</a></p>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</x-guest-layout>
