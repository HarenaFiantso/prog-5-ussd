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
        while (true) {
            $this->displayMenu($currentMenu);
            $choice = $this->prompt();
            if (!isset($currentMenu[$choice])) {
                echo "Option inconnue, Veuillez réessayer...\n";
            }
            $selection = $currentMenu[$choice];
            if (is_string($selection)) {
                match ($selection) {
                    ACTION_EXIT => $this->exit(),
                    ACTION_MAIN_MENU => $this->goToMainMenu(),
                    ACTION_BACK => $this->goBack(),
                    default => print("Option inconnue")
                };
                return;
            }
            if (isset($selection['options'])) {
                $this->history[] = $currentMenu;
                $this->navigate($selection['options']);
            } else {
                echo $selection['title'] . "\n";
                echo "Simulation en cours";
                sleep(1);
                $this->goToMainMenu();
            }
            return;
        }
    }

    private function prompt(): string
    {
        echo "Choisissez une option : ";
        return trim(fgets(STDIN));
    }

    private function displayMenu(array $menu): void
    {
        foreach ($menu as $key => $value) {
            if ($key === 'title') continue;
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
