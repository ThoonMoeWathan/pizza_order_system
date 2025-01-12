@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    @if (session('deleteSuccess'))
                        <div class="col-6 offset-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search key : <span class="text-success">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-9">
                            <form action="{{ route('admin#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" id="" class="form-control"
                                        placeholder="Search..." value="{{ request('key') }}">
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> --}}

                    <div class="row mt-2">
                        <div class="col-2 offset-10 text-primary p-2 text-right">
                            <h4> <i class="fa-solid fa-file"></i> {{ $admin->total() }} </h4>
                        </div>
                    </div>
                    {{-- @if (count($categories) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($a->image == null)
                                                <img src="{{ asset('image/default_user.png') }}" class="img-thumbnil shadow-sm">
                                                {{-- @if ($a->gender == 'male')
                                                    <img src="{{ asset('image/default_user.png') }}" class="img-thumbnil shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/default_user.png') }}" class="img-thumbnil shadow-sm">
                                                @endif --}}
                                            @else
                                                <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnil shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" id="adminId" value="{{ $a->id }}">
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td class="col-3">
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                {{-- <a href="{{ route('admin#changeRole',$a->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Change Admin Role">
                                                            <i class="fa-solid fa-user-minus"></i>
                                                        </button>
                                                </a> --}}
                                                <select class="form-control statusChange">
                                                    <option value="user" @if($a->role == 'user') selected @endif>User</option>
                                                    <option value="admin" @if($a->role == 'admin') selected @endif>Admin</option>
                                                </select>
                                                <a href="{{ route('admin#delete',$a->id) }}" class="ms-3">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $admin->appends(request()->query())->links() }}
                        </div>
                    </div>
                    {{-- @else
                        <h3 class="text-secondary text-center mt-5">There is no category here.</h3>
                    @endif --}}
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            // change status
            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $adminId = $parentNode.find('#adminId').val();
                $data = {
                    'adminId' : $adminId,
                    'role' : $currentStatus
                }
                $.ajax({
                    type: 'get',
                    url: '/admin/change/role',
                    data: $data,
                    dataType: 'json'
                })
                location.reload();
            })
        })
    </script>
@endsection
