<?php
# https://bool.dev/blog/detail/porozhdayushchie-patterny-fabrichnyy-metod
#Назначение: определяет интерфейс для создания объекта, но оставляет подклассам решение о том, какой класс инстанцировать. Фабричный метод позволяет классу делегировать инстанцирование подклассам.
#Когда следует использовать фабричный метод
#Когда заранее неизвестно, объекты каких типов необходимо создавать;
#Когда система должна быть независимой от процесса создания новых объектов и расширяемой: в нее можно легко вводить новые классы, объекты которых система должна создавать;
#Когда создание новых объектов необходимо делегировать из базового класса классам наследникам;

#######################################
interface Product{
    public function getName();
}

class ProductA implements Product
{
    public function getName()
    {
        return 'Product A';
    }
}
class ProductB implements Product
{
    public function getName()
    {
        return 'Product B';
    }
}
########################################
interface Creator
{
    public function FactoryMethod();
}

class Creator1 implements Creator
{
    public function FactoryMethod()
    {
        return new ProductA();
    }
}

class Creator2 implements Creator
{
    public function FactoryMethod()
    {
        return new ProductB();
    }
}
###########################################
class MainApp
{
    public static function Main()
    {
        $creators = [];
        $creators[0] = new Creator1();
        $creators[1] = new Creator2();

        foreach($creators as $c1)
        {
            $product = $c1->FactoryMethod();
            var_dump($product->getName()); echo "<br/>";
        }
    }
}
