<?php

/**
 * Get paths for assets.
 */
class JsonManifest {
    private $manifest;

    public function __construct($manifest_path) {
        if (file_exists($manifest_path)) {
        $this->manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
        $this->manifest = [];
        }
    }

    public function get() {
        return $this->manifest;
    }

    public function getPath($key = '', $default = null) {
        $collection = $this->manifest;
        if (is_null($key)) {
            return $collection;
        }
        if (isset($collection[$key])) {
            return $collection[$key];
        }
        foreach (explode('.', $key) as $segment) {
            if (!isset($collection[$segment])) {
                return $default;
            } else {
                $collection = $collection[$segment];
            }
        }

        return $collection;
    }
}

/**
 * Return asset path based on the manifest.
 */
function asset_path($filename) {
    static $manifest;

    $filename = "/{$filename}";
    $dist_path = UNITY_A11Y_BB_URL . 'assets/dist';

    if (empty($manifest)) {
        $manifest_path = UNITY_A11Y_BB_DIR . 'assets/dist/mix-manifest.json';
        $manifest = new JsonManifest($manifest_path);
    }

    if (array_key_exists($filename, $manifest->get())) {
        return $dist_path . $manifest->get()[$filename];
    } else {
        return $dist_path . $filename;
    }
}
