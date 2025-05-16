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
        $this->displayWelcomeMessage();
        $this->navigate($this->menus['options']);
    }

    private function navigate(array $currentMenu): void
    {
        $this->displayMenu($currentMenu);
        $choice = $this->promptForChoice();

        if (!$this->isValidChoice($choice, $currentMenu)) {
            $this->handleInvalidChoice($currentMenu);
            return;
        }

        $this->processSelection($currentMenu[$choice], $currentMenu);
    }

    private function displayWelcomeMessage(): void
    {
        echo "Simulation USSD démarrée...\n";
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

    private function promptForChoice(): string
    {
        echo "Choisissez une option (# pour quitter) : ";
        $input = trim(fgets(STDIN));

        if ($input === '#') {
            $this->exit();
        }

        if (!$this->isValidInput($input)) {
            echo "Option invalide, veuillez entrer un numéro ou # pour quitter.\n";
            return $this->promptForChoice();
        }

        return $input;
    }

    private function isValidInput(string $input): bool
    {
        return is_numeric($input) && $input !== '';
    }

    private function isValidChoice(string $choice, array $currentMenu): bool
    {
        return isset($currentMenu[$choice]);
    }

    private function handleInvalidChoice(array $currentMenu): void
    {
        echo "Option inconnue, veuillez réessayer...\n";
        $this->navigate($currentMenu);
    }

    private function processSelection(mixed $selection, array $currentMenu): void
    {
        if (is_string($selection)) {
            $this->handleAction($selection);
        } elseif (isset($selection['options'])) {
            $this->navigateToSubMenu($currentMenu, $selection['options']);
        } else {
            $this->handleContentDisplay($selection);
        }
    }

    private function handleAction(string $action): void
    {
        match ($action) {
            ACTION_EXIT => $this->exit(),
            ACTION_MAIN_MENU => $this->goToMainMenu(),
            ACTION_BACK => $this->goBack(),
            default => $this->handleUnknownAction()
        };
    }

    private function handleUnknownAction(): void
    {
        echo "Option inconnue\n";
        $this->goToMainMenu();
    }

    private function navigateToSubMenu(array $currentMenu, array $subMenu): void
    {
        $this->history[] = $currentMenu;
        $this->navigate($subMenu);
    }

    private function handleContentDisplay(array $selection): void
    {
        echo $selection['title'] . "\n";
        echo "Simulation en cours\n";
        sleep(1);
        $this->goToMainMenu();
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
        $this->history = [];
        echo "Menu principal...\n";
        $this->navigate($this->menus['options']);
    }

    private function goBack(): void
    {
        if (empty($this->history)) {
            $this->goToMainMenu();
            return;
        }

        $previousMenu = array_pop($this->history);
        $this->navigate($previousMenu);
    }

    #[NoReturn]
    public function exit(): void
    {
        echo "Simulation USSD terminée...\n";
        exit(0);
    }
}
