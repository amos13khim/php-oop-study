<?php
// ===========================================================
// Полиморфизм КИТ 3
// ===========================================================
echo "<hr>";
require 'polymorphism/A.php';
require 'polymorphism/B.php';
$a1 = new A();
var_dump($a1 instanceof A);
echo '<br>';
$b1 = new B();
var_dump($b1 instanceof A);
var_dump($b1 instanceof B);
echo "<p>" . $b1->sayHello() . "</p>";
echo $b1->method2();

// ===========================================================
// Интерфейсы КИТ 2
// ===========================================================
echo "<hr>";
require 'interfaces/CalculateSquare.php';
require 'interfaces/Circle.php';
require 'interfaces/Rectangle.php';
require 'interfaces/Square.php';

$circle1 = new Circle('3');
var_dump($circle1 instanceof Circle);
var_dump($circle1 instanceof Rectangle);
var_dump($circle1 instanceof CalculateSquare);

$objects = [
    new Square(5),
    new Circle(4.3),
    new Rectangle(5,6)
];

foreach( $objects as $object ) {
    if( $object instanceof CalculateSquare) {
        echo "<p>Площадь равна " . $object->calculateSquare() . "</p>";
        echo "Данный объект представитель " . get_class($object);
    } else {
        echo "<p>Данный объект класса " . get_class($object) . " не реализует интерфейс CalculateSquare</p>";
    }
}

// ===========================================================
// Наследование КИТ 1
// ===========================================================
echo "<hr>";
require 'lesson1/Post.php';
require 'lesson1/Lesson.php';
require 'lesson1/PaidLesson.php';

$lesson = new Lesson('Post title', 'Post Text', 'Homework text');
$paidLesson = new PaidLesson('Урок о наследовании в PHP', 'Лол, кек, чебурек', 'Ложитесь спать, утро вечера мудренее', 99.9);

echo '<h1>'.$paidLesson->getTitle().'</h1>';
echo '<h2>'.$paidLesson->getText().'</h2>';
echo '<p>'.$paidLesson->getHomework().'</p>';
echo '<p>'.$paidLesson->getPrice().'</>';