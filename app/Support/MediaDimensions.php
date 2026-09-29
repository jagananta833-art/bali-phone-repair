<?php

namespace App\Support;

final class MediaDimensions
{
    /**
     * @return array{width: int, height: int}|null
     */
    public static function forPublicAsset(?string $relativePath): ?array
    {
        if (! is_string($relativePath) || $relativePath === '' || str_contains($relativePath, '..')) {
            return null;
        }

        static $cache = [];

        if (array_key_exists($relativePath, $cache)) {
            return $cache[$relativePath];
        }

        $path = public_path(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePath));
        $dimensions = @getimagesize($path);

        return $cache[$relativePath] = $dimensions === false
            ? null
            : ['width' => $dimensions[0], 'height' => $dimensions[1]];
    }
}
