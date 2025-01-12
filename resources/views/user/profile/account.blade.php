@extends('user.layouts.master')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8 bg-danger">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            @if (session('updateSuccess'))
                                <div class="col-6 offset-6">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check me-2"></i> {{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('user#accountChange',Auth::user()->id) }}"method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_user.png') }}"
                                            class="img-thumbnail shadow-sm">
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm" />
                                    @endif
                                    <div class="mt-3">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn bg-dark text-white col-12" type="submit">
                                            <i class="fa-solid fa-check me-1"></i> Save
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">

                                    <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('name',Auth::user()->name) }}" placeholder="Enter Admin Name...">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Gender</label>
                                    <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                                        <option value="">Choose Gender...</option>
                                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Email</label>
                                    <input id="cc-pament" name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('email',Auth::user()->email) }}" placeholder="Enter Admin Email...">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Phone</label>
                                    <input id="cc-pament" name="phone" type="number"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('phone',Auth::user()->phone) }}" placeholder="Enter Admin Phone...">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="" cols="30" rows="10" placeholder="Enter Admin Address...">{{ old('address',Auth::user()->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Role</label>
                                    <input id="cc-pament" name="role" type="text"
                                        class="form-control"
                                        aria-required="true" aria-invalid="false" value="{{ old('role',Auth::user()->role) }}" disabled>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
