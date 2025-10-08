<?php
// Bật hiển thị tất cả lỗi để dễ dàng gỡ lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>BÀI 2: LẬP TRÌNH HƯỚNG ĐỐI TƯỢNG (OOP) TRONG PHP</h1>";

// =========================================================================
// BÀI TẬP 01: Class và Object cơ bản
// =========================================================================
echo "<h2>Bài tập 01: Class Car</h2>";

class Car {
    // Thuộc tính (Property) - public: có thể truy cập từ bất cứ đâu
    public $brand;
    public $color;

    // Phương thức (Method)
    public function showInfo() {
        // $this->brand tham chiếu đến thuộc tính 'brand' của chính đối tượng đó
        echo "Brand: {$this->brand}, Color: {$this->color}<br>";
    }
}

// Sử dụng class Car
// 'new Car()' tạo ra một đối tượng (instance) từ lớp Car
$car1 = new Car();
$car1->brand = "Toyota"; // Gán giá trị cho thuộc tính
$car1->color = "Red";
$car1->showInfo(); // Gọi phương thức

$car2 = new Car();
$car2->brand = "Honda";
$car2->color = "Blue";
$car2->showInfo();


// =========================================================================
// BÀI TẬP 02: Constructor, Destructor và Phạm vi truy cập
// =========================================================================
echo "<h2>Bài tập 02: Class Student</h2>";

class Student {
    // Thuộc tính private: chỉ có thể truy cập từ bên trong class này
    private $name;
    private $age;

    // Constructor: phương thức đặc biệt, tự động được gọi khi 'new Student()'
    // Dùng để khởi tạo giá trị ban đầu cho đối tượng
    public function __construct($name, $age) {
        echo "Đối tượng Student được tạo.<br>";
        $this->name = $name;
        $this->age = $age;
    }

    // Phương thức public để truy cập và hiển thị thông tin private
    public function display() {
        echo "Name: {$this->name}, Age: {$this->age}<br>";
    }

    // Destructor: phương thức đặc biệt, tự động được gọi khi đối tượng bị hủy
    // (khi script kết thúc hoặc đối tượng không còn được tham chiếu đến)
    public function __destruct() {
        echo "Đối tượng Student {$this->name} đã bị hủy.<br>";
    }
}

// Sử dụng class Student
$student1 = new Student("Nguyen Van A", 20);
$student1->display();
// Khi script này chạy xong, bạn sẽ thấy thông báo từ __destruct()


// =========================================================================
// BÀI TẬP 03: Static và Kế thừa (extends)
// =========================================================================
echo "<h2>Bài tập 03: Static và Kế thừa</h2>";

class MathHelper {
    // Phương thức static: thuộc về LỚP, không thuộc về đối tượng
    // Có thể gọi trực tiếp mà không cần tạo đối tượng 'new MathHelper()'
    public static function add($a, $b) {
        return $a + $b;
    }
}

// Lớp AdvancedMath kế thừa từ MathHelper
// Nó sẽ có tất cả các thuộc tính và phương thức của MathHelper
class AdvancedMath extends MathHelper {
    // Bổ sung thêm phương thức static mới
    public static function pow($a, $b) {
        return $a ** $b;
    }
}

// Sử dụng các phương thức static
// Dùng toán tử :: để gọi phương thức static
echo "3 + 5 = " . MathHelper::add(3, 5) . "<br>";
echo "2 ^ 3 = " . AdvancedMath::pow(2, 3) . "<br>";
// Lớp con có thể gọi phương thức của lớp cha
echo "10 + 5 = " . AdvancedMath::add(10, 5) . "<br>";


// =========================================================================
// BÀI TẬP 04: Abstract Class và Interface
// =========================================================================
echo "<h2>Bài tập 04: Abstract class & Interface</h2>";

// Abstract class: Lớp trừu tượng - một bản thiết kế chưa hoàn chỉnh
// Không thể tạo đối tượng trực tiếp từ nó (không thể 'new Animal()')
// Nó định nghĩa một khuôn mẫu mà các lớp con PHẢI tuân theo.
abstract class Animal {
    // Phương thức trừu tượng: chỉ có tên, không có nội dung.
    // Lớp con kế thừa Animal BẮT BUỘC phải định nghĩa lại phương thức này.
    abstract public function makeSound();
}

// Interface: một "hợp đồng" quy định các hành vi (phương thức)
// Bất kỳ lớp nào 'implements' interface này đều PHẢI có phương thức run().
interface CanRun {
    public function run();
}

// Lớp Dog kế thừa từ Animal (phải có makeSound())
// và triển khai interface CanRun (phải có run())
class Dog extends Animal implements CanRun {
    // Định nghĩa nội dung cho phương thức trừu tượng từ lớp cha
    public function makeSound() {
        echo "Woof! Woof!<br>";
    }
    // Định nghĩa nội dung cho phương thức từ interface
    public function run() {
        echo "Dog is running...<br>";
    }
}

// Lớp Cat chỉ kế thừa từ Animal
class Cat extends Animal {
    public function makeSound() {
        echo "Meow! Meow!<br>";
    }
}

// Sử dụng
$dog = new Dog();
$dog->makeSound();
$dog->run();

$cat = new Cat();
$cat->makeSound();
// $cat->run(); // Lệnh này sẽ gây lỗi vì class Cat không có phương thức run()


// =========================================================================
// BÀI TẬP 05: Namespace (Mô phỏng)
// =========================================================================
echo "<h2>Bài tập 05: Namespace</h2>";
echo "<p><i>Lưu ý: Namespace thường được dùng với nhiều file và autoloading để hoạt động hiệu quả. Đây là cách mô phỏng trong một file.</i></p>";

// Định nghĩa một namespace để gói các class liên quan lại
namespace App\Models {
    class User {
        public function sayHello() {
            echo "Hello from User class! (trong namespace App\Models)<br>";
        }
    }
}

// Để sử dụng class trong namespace, ta dùng từ khóa 'use'
// Nó giống như một lối tắt để không phải gõ tên đầy đủ 'new App\Models\User()'
namespace { // Quay trở lại namespace toàn cục
    use App\Models\User;

    // Bây giờ có thể gọi User một cách ngắn gọn
    $user = new User();
    $user->sayHello();
}
echo "<hr>";
?>