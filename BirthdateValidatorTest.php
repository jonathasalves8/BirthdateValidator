<?php

use PHPUnit\Framework\TestCase;

require_once 'path/to/BirthdateValidator.php'; // ajuste o caminho conforme seu projeto

class BirthdateValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new BirthdateValidator();
    }

    public function testValidDate()
    {
        $this->expectNotToPerformAssertions(); // só quer garantir que não lança exceção
        $this->validator->validate('Birthdate', '1990-05-10');
    }

    public function testEmptyDate()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Birthdate é obrigatório');
        $this->validator->validate('Birthdate', '');
    }

    public function testInvalidFormat()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Data inválida');
        $this->validator->validate('Birthdate', '10/05/1990');
    }

    public function testZeroDate()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('0000-00-00');
        $this->validator->validate('Birthdate', '0000-00-00');
    }

    public function testFutureDate()
    {
        $futureDate = (new DateTime('+1 day'))->format('Y-m-d');
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('não pode ser no futuro');
        $this->validator->validate('Birthdate', $futureDate);
    }

    public function testTooOldDate()
    {
        $oldDate = (new DateTime('-131 years'))->format('Y-m-d');
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Idade acima de 130 anos');
        $this->validator->validate('Birthdate', $oldDate);
    }
}
