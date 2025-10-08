@extends('layouts.app')

@section('title','Tạo sinh viên mới')

@section('content')
<h2>Tạo sinh viên mới</h2>

<form method="post" action="{{ url('/students') }}">
  @csrf
  <div>
    <label>Tên</label><br>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name') <div style="color:#B91C1C">{{ $message }}</div> @enderror
  </div>
  <div>
    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}">
    @error('email') <div style="color:#B91C1C">{{ $message }}</div> @enderror
  </div>
  <div>
    <label>Tuổi</label><br>
    <input type="number" name="age" value="{{ old('age') }}">
    @error('age') <div style="color:#B91C1C">{{ $message }}</div> @enderror
  </div>
  <div>
    <label>Giới tính</label><br>
    <select name="gender">
      <option value="">-- Chọn --</option>
      <option value="male" @selected(old('gender')==='male')>Nam</option>
      <option value="female" @selected(old('gender')==='female')>Nữ</option>
    </select>
    @error('gender') <div style="color:#B91C1C">{{ $message }}</div> @enderror
  </div>
  <div>
    <label>Lớp</label><br>
    <input type="text" name="class_name" value="{{ old('class_name') }}">
    @error('class_name') <div style="color:#B91C1C">{{ $message }}</div> @enderror
  </div>
  <div style="margin-top:8px">
    <button type="submit">Lưu</button>
  </div>
</form>
@endsection
