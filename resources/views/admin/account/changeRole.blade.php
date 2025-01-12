@extends('admin.layouts.master')

@section('title', 'Category List')

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
                            <a href="{{ route('admin#list') }}">
                                <div class="ms-5">
                                {{-- <a href="{{ route('product#list') }}" class="text-decoration-none text-dark"> --}}
                                    <i class="fa-solid fa-arrow-left text-dark"></i>
                                {{-- </a> --}}
                            </div>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#change',$account->id) }}"method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="col-4 offset-1">
                                    @if ($account->image == null)
                                        <img src="{{ asset('image/default_user.png') }}"
                                            class="img-thumbnail shadow-sm">
                                    @else
                                        <img src="{{ asset('storage/'.$account->image) }}" class="img-thumbnail shadow-sm"/>
                                    @endif

                                    <div class="mt-3">
                                        <button class="btn bg-dark text-white col-12" type="submit">
                                            <i class="fa-solid fa-check me-1"></i> Change
                                        </button>
                                    </div>
                                </div>
                                <div class="row col-6">

                                    <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" disabled type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('name',$account->name) }}" placeholder="Enter Admin Name...">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Role</label>
                                    {{-- <input id="cc-pament" name="role" type="text"
                                        class="form-control"
                                        aria-required="true" aria-invalid="false" value="{{ old('role',$account->role) }}" disabled> --}}

                                    <select name="role" id="" class="form-control">
                                        <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                        <option value="user" @if($account->role == 'user') selected @endif>User</option>
                                    </select>
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Gender</label>
                                    <select name="gender" disabled id="" class="form-control @error('gender') is-invalid @enderror">
                                        <option value="">Choose Gender...</option>
                                        <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Email</label>
                                    <input id="cc-pament" name="email" disabled type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('email',$account->email) }}" placeholder="Enter Admin Email...">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Phone</label>
                                    <input id="cc-pament" name="phone" disabled type="number"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('phone',$account->phone) }}" placeholder="Enter Admin Phone...">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" disabled id="" cols="30" rows="10" placeholder="Enter Admin Address...">{{ old('address',$account->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
