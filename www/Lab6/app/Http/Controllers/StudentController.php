<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = [
            ['name' => 'Nguyễn An',   'age' => 19, 'email' => 'an@huit.edu.vn'],
            ['name' => 'Trần Bình',   'age' => 18, 'email' => 'binh@huit.edu.vn'],
            ['name' => 'Lê Chi',      'age' => 17, 'email' => 'chi@huit.edu.vn'],
            ['name' => 'Phạm Dũng',   'age' => 20, 'email' => 'dung@huit.edu.vn'],
            ['name' => 'Đỗ Em',       'age' => 21, 'email' => 'em@huit.edu.vn'],
        ];
        return view('students.index', compact('students'));
    }

    public function indexDb(Request $request)
    {
        $students = Student::orderBy('id', 'desc')->paginate(5);
        return view('students.index_db', compact('students'));
    }

    public function combined()
    {
        $static = [
            ['name' => 'Nguyễn An', 'age' => 19, 'email' => 'an@huit.edu.vn', 'gender' => 'male'],
            ['name' => 'Trần Bình', 'age' => 18, 'email' => 'binh@huit.edu.vn', 'gender' => 'male'],
            ['name' => 'Lê Chi', 'age' => 17, 'email' => 'chi@huit.edu.vn', 'gender' => 'female'],
        ];
        $db = Student::orderBy('id', 'desc')->paginate(5);
        $source = request('source', 'db');
        return view('students.combined', compact('static', 'db', 'source'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'nullable|integer|min:16',
            'gender' => 'nullable|in:male,female',
            'class_name' => 'nullable|string|max:255'
        ]);
        Student::create($data);
        return redirect('/students/db')->with('success', 'Tạo mới thành công');
    }
}
