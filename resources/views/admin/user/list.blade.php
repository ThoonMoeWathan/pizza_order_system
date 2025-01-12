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
                            <i class="fa-solid fa-check"></i>  {{session('deleteSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <div class="table-responsive table-responsive-data2">
                        <h3> Total - {{$users->total()}} </h3>
                        @if (count($users) != 0)
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($users as $user)
                                <tr>
                                    <td class="col-2">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm">
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm"/>
                                    @endif
                                    </td>
                                    <input type="hidden" id="userId" value="{{ $user->id }}">
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->gender }} </td>
                                    <td> {{ $user->phone }} </td>
                                    <td> {{ $user->address }} </td>
                                    <td class="col-2">
                                        <select class="form-control statusChange">
                                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                                    <a href="{{ route('admin#deleteUser', $user->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                         @else
                        <h3 class="text-secondary text-center mt-5">There is no users yet.</h3>
                        @endif
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
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
                $userId = $parentNode.find('#userId').val();
                $data = {
                    'userId' : $userId,
                    'role' : $currentStatus
                }
                $.ajax({
                    type: 'get',
                    url: '/user/change/role',
                    data: $data,
                    dataType: 'json'
                })
                location.reload();
            })
        })
    </script>
@endsection

