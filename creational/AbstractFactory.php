<?php
# https://bool.dev/blog/detail/porozhdayushchie-shablony-abstract-factory
# Назначение: абстрактная фабрика предоставляет интерфейс для создания семейства взаимосвязанных или родственных объектов
#       (dependent or related objects), не специфицируя их конкретных классов.
# Другими словами: абстрактная фабрика представляет собой стратегию создания семейства взаимосвязанных или родственных объектов.
# Когда следует использовать абстрактную фабрику
# Когда система не должна зависеть от способа создания новых объектов
# Когда создаваемые объекты должны использоваться вместе и являются взаимосвязанными

#################################
interface AbstractFactory
{
    public function CreateProductA();
    public function CreateProductB();

}
###################################
class Factory1 implements AbstractFactory
{
    public function createProductA()
    {
        return new ProductA1();
    }
    public function createProductB()
    {
        return new ProductB1();
    }
}

class Factory2 implements AbstractFactory
{
    public function createProductA()
    {
        return new ProductA2();
    }
    public function createProductB()
    {
        return new ProductB2();
    }
}
########################################
interface AbstractProductA
{

}
interface AbstractProductB
{
    public function Interact(AbstractProductA $product);
}
#######################################
class ProductA1 implements AbstractProductA
{

}

class ProductB1 implements AbstractProductB
{
    public function Interact(AbstractProductA $product)
    {
        var_dump($product);
        echo "<br/><br/>";
    }
}

class ProductA2 implements AbstractProductA
{

}

class ProductB2 implements AbstractProductB
{
    public function Interact(AbstractProductA $product)
    {
        var_dump($product);
        echo "<br/><br/>";
    }
}

###########################################
class Client
{
    private $productA;
    private $productB;

    public function __construct(AbstractFactory $factory)
    {
        $this->productA = $factory->createProductA();
        $this->productB = $factory->createProductB();
    }

    public function Run()
    {
        $this->productB->interact($this->productA);
    }
}
##########################################
class MainApp
{
    public static function main()
    {
        $factory1 = new Factory1();
        $client1 = new Client($factory1);
        $client1->Run();

        $factory2 = new Factory2();
        $client2 = new Client($factory2);
        $client2->Run();
    }
}
MainApp::main();