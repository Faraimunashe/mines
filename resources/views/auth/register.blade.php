<x-guest-layout>
    <div class="app-main">
        <div class="app-main__outer">
            <div class="app-main__inner">
                <section class="vh-100">
                    <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 text-black">

                        <div class="px-5 ms-xl-4">
                            <i style="color: #709085;"></i>
                            <span class="h1 fw-bold mb-0">Logo</span>
                        </div>

                            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                                <form action="{{ route('register') }}" method="POST" style="width: 23rem;">
                                    @csrf
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                    <div class="form-outline mb-4">
                                        <select id="form2Example18" name="role" class="form-control form-control-lg" required>
                                            <option selected disabled>Select Role</option>
                                            <option value="client">Client</option>
                                            <option value="consultant">Consultant</option>
                                            <option value="mine">Mine Owner</option>
                                        </select>
                                        <label class="form-label" for="form2Example18">Access Role</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form2Example18" name="name" class="form-control form-control-lg" required/>
                                        <label class="form-label" for="form2Example18">Username</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="form2Example18" name="email" class="form-control form-control-lg" required/>
                                        <label class="form-label" for="form2Example18">Email address</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="form2Example28" name="password" class="form-control form-control-lg" required/>
                                        <label class="form-label" for="form2Example28">Password</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="form2Example28" name="password_confirmation" class="form-control form-control-lg" required/>
                                        <label class="form-label" for="form2Example28">Password Confirmation</label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                                    </div>

                                    <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                                    <p>Already have an account? <a href="{{ route('login') }}" class="link-info">Login here</a></p>

                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6 px-0 d-none d-sm-block">
                        <img src="{{ asset('assets/images/darkmineral.jpg') }}"
                            alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                        </div>
                    </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-guest-layout>

