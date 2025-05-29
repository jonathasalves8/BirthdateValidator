<?php

use Adianti\Validator\TFieldValidator;
use Adianti\Core\AdiantiCoreTranslator;

class BirthdateValidator extends TFieldValidator
{
    /**
     * Valida a data de nascimento (formato: YYYY-MM-DD)
     * 
     * Rejeita:
     * - "0000-00-00"
     * - Datas inválidas ou irreais
     * - Datas futuras
     * - Idades acima de 130 anos
     *
     * @param string $label Nome do campo
     * @param mixed $value Valor a ser validado
     * @param array $parameters Não usado
     * @throws Exception Se a data for inválida
     */
    public function validate($label, $value, $parameters = null)
    {
        if (empty($value)) {
            throw new Exception("O campo {$label} é obrigatório.");
        }

        if ($value === '0000-00-00') {
            throw new Exception("{$label}: Data inválida (0000-00-00).");
        }

        // Converte usando TDate (caso seja DD/MM/YYYY)
        if (strpos($value, '/') !== false) {
            $value = TDate::date2us($value); // Converte para YYYY-MM-DD
        }

        [$year, $month, $day] = explode('-', $value);

        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            throw new Exception("{$label}: Data inválida.");
        }

        $birthDate = new DateTime($value);
        $today = new DateTime();

        if ($birthDate > $today) {
            throw new Exception("{$label}: A data não pode ser no futuro.");
        }

        $age = $today->diff($birthDate)->y;

        if ($age > 130) {
            throw new Exception("{$label}: Idade acima de 130 anos.");
        }
    }
}
