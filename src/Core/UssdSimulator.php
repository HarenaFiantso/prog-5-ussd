<?php

namespace Harenafiantso\Prog5Ussd\Core;

use JetBrains\PhpStorm\NoReturn;

class UssdSimulator
{
    private readonly MenuRenderer $renderer;
    private readonly InputHandler $inputHandler;
    private readonly NavigationService $navigation;

    public function __construct(
        array              $menus,
        ?MenuRenderer      $renderer = null,
        ?InputHandler      $inputHandler = null,
        ?NavigationService $navigation = null
    )
    {
        $this->renderer = $renderer ?? new MenuRenderer();
        $this->inputHandler = $inputHandler ?? new InputHandler();
        $this->navigation = $navigation ?? new NavigationService($menus);
    }

    public function start(): void
    {
        $this->renderer->displayWelcomeMessage();
        $this->navigate($this->navigation->getMainMenu());
    }

    private function navigate(array $currentMenu): void
    {
        try {
            $this->renderer->displayMenu($currentMenu);
            $choice = $this->inputHandler->promptForChoice();

            if (!$this->inputHandler->isValidChoice($choice, $currentMenu)) {
                $this->handleInvalidChoice($currentMenu);
                return;
            }

            $this->processSelection($currentMenu[$choice], $currentMenu);
        } catch (ExitSimulationException) {
            $this->exit();
        }
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
            $this->navigate($this->navigation->navigateToSubMenu($currentMenu, $selection['options']));
        } else {
            $this->renderer->displayContent($selection);
            sleep(1);
            $this->goToMainMenu();
        }
    }

    private function handleAction(string $action): void
    {
        match ($action) {
            ACTION_EXIT => $this->exit(),
            ACTION_MAIN_MENU => $this->goToMainMenu(),
            ACTION_BACK => $this->navigate($this->navigation->goBack()),
            default => $this->handleUnknownAction()
        };
    }

    private function handleUnknownAction(): void
    {
        echo "Option inconnue\n";
        $this->goToMainMenu();
    }

    private function goToMainMenu(): void
    {
        $this->navigation->resetHistory();
        echo "Menu principal...\n";
        $this->navigate($this->navigation->getMainMenu());
    }

    #[NoReturn]
    public function exit(): void
    {
        echo "Simulation USSD terminée...\n";
        exit(0);
    }
}