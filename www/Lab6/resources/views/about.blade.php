@extends('layouts.app')

@section('title','Giới thiệu khóa học')

@section('content')
<x-card>
  <x-slot name="title">Giới thiệu khóa học: Lập trình Mã nguồn mở</x-slot>
  <p>Mục tiêu: Hiểu framework, MVC, Eloquent, Blade, migration.</p>
  <p>Lịch 7 buổi lab:</p>
  <ol>
    <li>Giới thiệu Laravel, setup</li>
    <li>Routing, Controller, View</li>
    <li>Eloquent & Migration</li>
    <li>Form, Validation, CSRF</li>
    <li>Component & Blade advanced</li>
    <li>Testing & Seeder</li>
    <li>Tổng kết & báo cáo</li>
  </ol>
  <p>Chuẩn đầu ra: Sinh viên nắm được MVC, thực hành CRUD, migration và testing cơ bản.</p>
</x-card>
@endsection
