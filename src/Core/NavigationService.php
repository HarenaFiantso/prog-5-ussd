<?php

namespace Harenafiantso\Prog5Ussd\Core;

class NavigationService
{
    private array $history = [];
    private array $menus;

    public function __construct(array $menus)
    {
        $this->menus = $menus;
    }

    public function getMainMenu(): array
    {
        return $this->menus['options'];
    }

    public function navigateToSubMenu(array $currentMenu, array $subMenu): array
    {
        $this->history[] = $currentMenu;
        return $subMenu;
    }

    public function goBack(): array
    {
        if (empty($this->history)) {
            return $this->getMainMenu();
        }

        return array_pop($this->history);
    }

    public function resetHistory(): void
    {
        $this->history = [];
    }
}
