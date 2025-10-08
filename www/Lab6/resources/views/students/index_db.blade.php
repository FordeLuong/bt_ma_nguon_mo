@extends('layouts.app')

@section('title','Danh sách sinh viên (DB)')

@section('content')
<h2>Danh sách sinh viên – Nguồn: Mảng tĩnh</h2>

<form method="get" action="{{ url('/students/db') }}" style="margin-bottom:12px">
  <label>Lọc giới tính:</label>
  <select name="gender" onchange="this.form.submit()">
    <option value="" @selected(empty($gender))>Tất cả</option>
    <option value="male" @selected(($gender ?? '') === 'male')>Nam</option>
    <option value="female" @selected(($gender ?? '') === 'female')>Nữ</option>
  </select>
</form>

<table>
  <thead>
    <tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Giới tính</th><th>Email</th><th>Nhãn tuổi</th></tr>
  </thead>
  <tbody>
    @foreach($students as $s)
      <tr>
        <td>{{ $loop->iteration + ($students->currentPage()-1)*$students->perPage() }}</td>
        <td>{{ $s->name }}</td>
        <td @class(['adult' => ($s->age ?? 0) >= 18])>{{ $s->age }}</td>
        <td>{{ $s->gender }}</td>
        <td>{{ $s->email }}</td>
        <td>
          <x-badge :age="$s->age"/>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>


@endsection
