<?php

declare(strict_types=1);

if (!function_exists('detect_type_by_name')) {
    function detect_type_by_name(string $filename): string
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        return $extension;
    }
}
