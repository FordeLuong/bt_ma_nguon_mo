@extends('layouts.app')
@section('title', 'Chi tiết Bài Viết')
@section('page-title', 'Chi tiết Bài Viết')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Bài viết</a></li>
    <li class="breadcrumb-item active">Chi tiết</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ $post->title }}</h4>
            <span class="badge bg-{{ $post->published_at ? 'success' : 'warning' }}">
                {{ $post->published_at ? 'Đã xuất bản' : 'Bản nháp' }}
            </span>
        </div>
        <div class="card-body">
            <p><strong>Tác giả:</strong> {{ $post->author }}</p>
            <p><strong>Ngày tạo:</strong> {{ $post->created_at->format('d/m/Y H:i') }}</p>
            <hr>
            <div>{!! nl2br(e($post->content)) !!}</div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Chỉnh sửa</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
@endsection