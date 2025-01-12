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
                            {{-- <div class="ms-5">
                                <a href="{{ route('product#list') }}">
                                    <i class="fa-solid fa-arrow-left text-dark"></i>
                                </a>
                            </div> --}}
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}"method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="col-4 offset-1">
                                    <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                        <img src="{{ asset('storage/'.$pizza->image) }}"
                                            class="img-thumbnail shadow-sm">
                                    <div class="mt-3">
                                        <input type="file" class="form-control @error('pizzaImage') is-invalid @enderror" name="pizzaImage" >
                                        @error('pizzaImage')
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
                                <div class="row col-6">

                                    <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text"
                                        class="form-control @error('pizzaName') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('pizzaName',$pizza->name) }}" placeholder="Enter Pizza Name...">
                                    @error('pizzaName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Description</label>
                                    <textarea class="form-control @error('pizzaDescription') is-invalid @enderror" name="pizzaDescription" id="" cols="30" rows="10" placeholder="Enter Pizza Description...">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                    @error('pizzaDescription')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                        <option value="">Choose Category...</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number"
                                        class="form-control @error('pizzaPrice') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('pizzaPrice',$pizza->price) }}" placeholder="Enter Pizza Price...">
                                    @error('pizzaPrice')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                        class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" placeholder="Enter Waiting Time...">
                                    @error('pizzaWaitingTime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">View Count</label>
                                    <input id="cc-pament" name="viewCount" type="number"
                                        class="form-control"
                                        aria-required="true" aria-invalid="false" value="{{ old('viewCount',$pizza->view_count) }}" disabled>
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label mb-1">Created Date</label>
                                    <input id="cc-pament" name="createdAt" type="text"
                                        class="form-control"
                                        aria-required="true" aria-invalid="false" value="{{ $pizza->created_at->format('j F Y') }}" disabled>
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
