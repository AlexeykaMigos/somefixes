<?php

/**
 * Polyfill for Livewire tmpfile() namespace bug.
 * Some PHP configurations don't resolve global tmpfile() from within
 * Livewire\Features\SupportFileUploads namespace.
 */
namespace Livewire\Features\SupportFileUploads;

if (!function_exists('Livewire\Features\SupportFileUploads\tmpfile')) {
    function tmpfile()
    {
        // Try global tmpfile first
        if (function_exists('\tmpfile')) {
            $f = @\tmpfile();
            if ($f) return $f;
        }

        // Mock tmpfile using a real temporary file if global is disabled
        try {
            $tempPath = tempnam(sys_get_temp_dir(), 'lw_');
            if ($tempPath) {
                // We don't delete it immediately because Livewire needs to write to it
                // It will be a resource, and we hope PHP cleans up or Livewire handles it
                return fopen($tempPath, 'r+');
            }
        } catch (\Exception $e) {}

        // Absolute fallback
        return fopen('php://temp', 'r+');
    }
}
