<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;

class HtmlSanitizer
{
    private const ALLOWED_TAGS = [
        'a', 'b', 'blockquote', 'br', 'em', 'h2', 'h3', 'h4', 'img', 'li', 'ol', 'p', 'strong', 'ul',
    ];

    private const GLOBAL_ATTRIBUTES = ['class', 'title'];

    private const TAG_ATTRIBUTES = [
        'a' => ['href', 'rel', 'target'],
        'img' => ['alt', 'decoding', 'height', 'loading', 'src', 'width'],
    ];

    public static function clean(?string $html): string
    {
        if (! is_string($html) || trim($html) === '') {
            return '';
        }

        $dom = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?><div>'.$html.'</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $root = $dom->getElementsByTagName('div')->item(0);
        if (! $root) {
            return '';
        }

        self::sanitizeChildren($root);

        $clean = '';
        foreach ($root->childNodes as $child) {
            $clean .= $dom->saveHTML($child);
        }

        return trim($clean);
    }

    private static function sanitizeChildren(DOMNode $node): void
    {
        for ($child = $node->firstChild; $child !== null;) {
            $next = $child->nextSibling;

            if ($child instanceof DOMElement) {
                $tag = strtolower($child->tagName);

                if (! in_array($tag, self::ALLOWED_TAGS, true)) {
                    self::unwrapOrRemove($child, in_array($tag, ['script', 'style', 'iframe', 'object', 'embed'], true));
                    $child = $next;
                    continue;
                }

                self::sanitizeAttributes($child);
            }

            if ($child->hasChildNodes()) {
                self::sanitizeChildren($child);
            }

            $child = $next;
        }
    }

    private static function sanitizeAttributes(DOMElement $element): void
    {
        $tag = strtolower($element->tagName);
        $allowed = array_merge(self::GLOBAL_ATTRIBUTES, self::TAG_ATTRIBUTES[$tag] ?? []);

        foreach (iterator_to_array($element->attributes) as $attribute) {
            $name = strtolower($attribute->name);
            $value = trim($attribute->value);

            if (! in_array($name, $allowed, true) || str_starts_with($name, 'on')) {
                $element->removeAttribute($attribute->name);
                continue;
            }

            if (in_array($name, ['href', 'src'], true) && ! self::isSafeUrl($value)) {
                $element->removeAttribute($attribute->name);
            }
        }

        if ($tag === 'a') {
            $element->setAttribute('rel', 'noopener noreferrer');
        }
    }

    private static function isSafeUrl(string $value): bool
    {
        if ($value === '' || str_starts_with($value, '/') || str_starts_with($value, '#')) {
            return true;
        }

        $scheme = strtolower((string) parse_url($value, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https', 'mailto', 'tel'], true);
    }

    private static function unwrapOrRemove(DOMElement $element, bool $remove): void
    {
        $parent = $element->parentNode;
        if (! $parent) {
            return;
        }

        if (! $remove) {
            while ($element->firstChild) {
                $parent->insertBefore($element->firstChild, $element);
            }
        }

        $parent->removeChild($element);
    }
}
