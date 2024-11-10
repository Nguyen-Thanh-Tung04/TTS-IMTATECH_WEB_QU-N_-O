@extends('admin.layouts.master')

@section('title')
    Danh sách Tài khoản
@endsection

@section('content')
    <a href="{{ route('admin.banners.create') }}">
        <button class="btn btn-success">Tạo mới tài khoản</button>
    </a>
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Trạng thái</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Trạng thái</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->status === 'active' ? 'Hoạt động' : 'Đã khóa' }}</td>
                                    <td class="d-flex ">
                                        <!-- Toggle Type Button -->
                                        <form action="{{ route('admin.accounts.toggleType', $item) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-primary" onclick="return confirm('Are you sure you want to change this user\'s type?')">
                                                {{ $item->type === 'admin' ? 'Hạ -> Member' : 'Nâng -> Admin' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.accounts.toggleStatus', $item) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning " style="background-color: {{ $item->status === 'active' ? '#28a745' : '#dc3545' }}; color: white; padding: 5px; text-align: center;">
                                                {{ $item->status === 'active' ? 'Khóa' : 'Mở khóa' }} tài khoản
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
