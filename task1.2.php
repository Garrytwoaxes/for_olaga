<?php
Interface A {
Public function check($content);
}
abstract Class B implements A { //Ошибка была в том, что класс для Интерфейса должен быть абстрактным, и объекты на его основе не создаются
Protected $options;
Public function construct($content)
{
Return $this->options=$options;
}
}

?>