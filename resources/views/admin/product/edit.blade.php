@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-4 offset-6 mb-2">
                @if (session('updateSuccess'))
                        <div class="">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i>  {{session('updateSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                {{-- <a href="{{ route('product#list') }}" class="text-decoration-none text-dark"> --}}
                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                {{-- </a> --}}
                            </div>
                            {{-- <div class="card-title">
                                <h3 class="text-center title-2">Pizza Detail</h3>
                            </div> --}}
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm">
                                </div>
                                <div class="col-8">
                                    <h3 class="mb-3 btn bg-danger text-white d-block fs-5 w-50 text-center">{{$pizza->name}}</h3>
                                    <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-money-bill-1-wave me-2"></i>{{$pizza->price}} Kyats</span>
                                    <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-clock me-2"></i>{{$pizza->waiting_time}} mins</span>
                                    <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-eye me-2"></i>{{$pizza->view_count}}</span>
                                    <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-clone me-2"></i>{{$pizza->category_name}}</span>
                                    <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-user-clock me-2"></i>{{$pizza->created_at->format('j F Y')}}</span>
                                    <div class="my-3"><i class="fa-solid fs-4 fa-file-lines me-2"></i>Detail</div>
                                    <div class="">{{$pizza->description}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
