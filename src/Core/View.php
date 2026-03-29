<?php

class View
{
    public static function render(string $view, array $data = [], string $template = 'frontend'): void
    {
        $viewPath = VIEWS_PATH . '/' . ltrim($view, '/');
        if (!file_exists($viewPath)) {
            throw new Exception("Vue introuvable: {$view}");
        }

        $templatePath = VIEWS_PATH . '/templates/' . $template . '.php';
        if (!file_exists($templatePath)) {
            throw new Exception("Template introuvable: {$template}");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        include $templatePath;
    }

    public static function partial(string $partial, array $data = []): void
    {
        $partialPath = VIEWS_PATH . '/partials/' . ltrim($partial, '/');
        if (!file_exists($partialPath)) {
            throw new Exception("Partial introuvable: {$partial}");
        }

        extract($data, EXTR_SKIP);
        include $partialPath;
    }
}
