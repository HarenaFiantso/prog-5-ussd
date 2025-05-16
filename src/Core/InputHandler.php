<?php

namespace Harenafiantso\Prog5Ussd\Core;

class InputHandler
{
    /**
     * @throws ExitSimulationException
     */
    public function promptForChoice(): string
    {
        echo "Choisissez une option (# pour quitter) : ";
        $input = trim(fgets(STDIN));

        if ($input === '#') {
            throw new ExitSimulationException();
        }

        if (!$this->isValidInput($input)) {
            echo "Option invalide, veuillez entrer un numéro ou # pour quitter.\n";
            return $this->promptForChoice();
        }

        return $input;
    }

    public function isValidInput(string $input): bool
    {
        return is_numeric($input) && $input !== '';
    }

    public function isValidChoice(string $choice, array $currentMenu): bool
    {
        return isset($currentMenu[$choice]);
    }
}