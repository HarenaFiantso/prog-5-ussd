<?php

namespace Harenafiantso\Prog5Ussd\Core;

class MenuRenderer
{
    public function displayWelcomeMessage(): void
    {
        echo "Simulation USSD démarrée...\n";
    }

    public function displayMenu(array $menu): void
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

    public function displayContent(array $selection): void
    {
        echo $selection['title'] . "\n";
        echo "Simulation en cours\n";
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
}