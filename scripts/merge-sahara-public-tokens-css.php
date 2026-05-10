#!/usr/bin/env php
<?php

/**
 * Rebuild public/css/sahara-public-tokens.css from Blade token partials (no Blade directives).
 * Run after editing resources/views/components/public-*-tokens*.blade.php
 */
$base = dirname(__DIR__) . '/resources/views/components';
$outPath = dirname(__DIR__) . '/public/css/sahara-public-tokens.css';

$typ = file_get_contents($base . '/public-typography-tokens.blade.php');
$eff = file_get_contents($base . '/public-effects-tokens.blade.php');
$mot = file_get_contents($base . '/public-motion-tokens.blade.php');
$des = file_get_contents($base . '/public-design-tokens.blade.php');
$a11yFull = file_get_contents($base . '/public-a11y-tokens.blade.php');

if (str_starts_with(ltrim($a11yFull), '{{--')) {
    $end = strpos($a11yFull, '--}}');
    $a11y = $end !== false ? ltrim(substr($a11yFull, $end + 4)) : $a11yFull;
} else {
    $a11y = $a11yFull;
}

$eff = str_replace("@include('components.public-motion-tokens')", $mot, $eff);

$out = <<<'HDR'
/* sahara-public-tokens.css — merged from Blade token partials; external sheet so the HTML parser never sees token text as markup */
HDR;
$out .= "\n/* --- public-typography-tokens --- */\n" . rtrim($typ) . "\n\n";
$out .= "/* --- public-effects-tokens + motion --- */\n" . rtrim($eff) . "\n\n";
$out .= "/* --- public-design-tokens --- */\n" . rtrim($des) . "\n\n";
$out .= "/* --- public-a11y-tokens --- */\n" . rtrim($a11y) . "\n\n";
$out .= "/* Regenerate: php scripts/merge-sahara-public-tokens-css.php */\n";

file_put_contents($outPath, $out);
fwrite(STDERR, "Wrote {$outPath} (" . strlen($out) . " bytes)\n");
