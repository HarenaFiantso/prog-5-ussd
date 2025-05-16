<?php

namespace Harenafiantso\Prog5Ussd\Core;

use JetBrains\PhpStorm\NoReturn;

class UssdSimulator
{
    private array $history = [];

    public function __construct(private readonly array $menus)
    {
    }

    public function start(): void
    {
        echo "Simulation USSD démarrée...\n";
        $this->navigate($this->menus['options']);
    }

    private function navigate(array $currentMenu): void
    {
        $this->displayMenu($currentMenu);
        $choice = $this->prompt();
        if (!isset($currentMenu[$choice])) {
            echo "Option inconnue, veuillez réessayer...\n";
            $this->navigate($currentMenu);
        }
        $selection = $currentMenu[$choice];
        if (is_string($selection)) {
            match ($selection) {
                ACTION_EXIT => $this->exit(),
                ACTION_MAIN_MENU => $this->goToMainMenu(),
                ACTION_BACK => $this->goBack(),
                default => print("Option inconnue\n")
            };
        } elseif (isset($selection['options'])) {
            $this->history[] = $currentMenu;
            $this->navigate($selection['options']);
        } else {
            echo $selection['title'] . "\n";
            echo "Simulation en cours\n";
            sleep(1);
            $this->goToMainMenu();
        }
    }

    private function prompt(): string
    {
        echo "Choisissez une option (# pour quitter) : ";
        $input = trim(fgets(STDIN));
        if ($input === '#') {
            $this->exit();
        }
        if (!is_numeric($input) || $input === '') {
            echo "Option invalide, veuillez entrer un numéro ou # pour quitter.\n";
            return $this->prompt();
        }

        return $input;
    }

    private function displayMenu(array $menu): void
    {
        foreach ($menu as $key => $value) {
            if ($key === 'title') {
                continue;
            }
            if (is_array($value) && isset($value['title'])) {
                echo "$key. {$value['title']}\n";
            } elseif (is_string($value)) {
                echo "$key. " . $this->resolveActionName($value) . "\n";
            }
        }
    }

    private function resolveActionName(string $action): string
    {
        return match ($action) {
            ACTION_EXIT => "Quitter",
            ACTION_MAIN_MENU => "Menu principal",
            ACTION_BACK => "Retour",
            default => "Option inconnue"
        };
    }

    private function goToMainMenu(): void
    {
        echo "Menu principal...\n";
    }

    private function goBack(): void
    {
        if (empty($this->history)) {
            $this->goToMainMenu();
        } else {
            $previousMenu = array_pop($this->history);
            $this->navigate($previousMenu);
        }
    }

    #[NoReturn] public function exit(): void
    {
        echo "Simulation USSD terminée...\n";
        exit;
    }
}
