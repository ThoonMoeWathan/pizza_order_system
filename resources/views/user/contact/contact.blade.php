@extends('user.layouts.master')

@section('content')
    <div class="col-6 offset-3">
        <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Contact Form</h3>
                            </div>
                            @if (session('contactSuccess'))
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check me-2"></i> {{ session('contactSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <form action="{{ route('user#contact') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Email</label>
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                    <input id="cc-pament" name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="example@gmail.com" value="{{old('email')}}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-5">
                                    <label class="control-label mb-1">Message</label>
                                    <textarea name="message" id="cc-pament" class="form-control @error('message') is-invalid @enderror" cols="30" rows="10" aria-required="true" aria-invalid="false" placeholder="What are your thoughts?">{{old('message')}}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-lg bg-dark text-white btn-block">
                                        <span>Send</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
