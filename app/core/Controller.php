<?php 
class Controller {

    public function view($view, $data = []) {
        $baseDir = dirname(__DIR__) . '/views/';
        $file = $baseDir . $view . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }

        // Fallback case-insensitive untuk Linux hosting
        $resolved = $this->resolveCaseInsensitivePath($baseDir, $view . '.php');
        if ($resolved && file_exists($resolved)) {
            require_once $resolved;
            return;
        }

        require_once $file;
    }

    private function resolveCaseInsensitivePath($baseDir, $relativePath) {
        $parts = explode('/', str_replace('\\', '/', $relativePath));
        $current = rtrim($baseDir, '/\\');

        foreach ($parts as $part) {
            if (!is_dir($current)) {
                return false;
            }
            $items = scandir($current);
            $found = false;
            foreach ($items as $item) {
                if (strcasecmp($item, $part) === 0) {
                    $current .= '/' . $item;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                return false;
            }
        }
        return $current;
    }

    public function model($model){
        $baseDir = dirname(__DIR__) . '/models/';
        $file = $baseDir . $model . '.php';
        if (!file_exists($file)) {
            $resolved = $this->resolveCaseInsensitivePath($baseDir, $model . '.php');
            if ($resolved) $file = $resolved;
        }
        require_once $file;
        return new $model;
    }

    public function helper($helper, $params = NULL){
        $baseDir = dirname(__DIR__) . '/helpers/';
        $file = $baseDir . $helper . '.php';
        if (!file_exists($file)) {
            $resolved = $this->resolveCaseInsensitivePath($baseDir, $helper . '.php');
            if ($resolved) $file = $resolved;
        }
        require_once $file;
        if ($params) {
            return new $helper($params);
        } else {
            return new $helper;
        }
    }
}
?>
