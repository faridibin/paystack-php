<?php

/**
 * Spec-conformance guard.
 *
 * Statically scans every Service class for `$this->client->send('VERB', '/path')`
 * calls, normalizes their verb+path, and diffs the result against the canonical
 * endpoint list derived from Paystack's official OpenAPI spec
 * (tests/SpecEndpoints.php).
 *
 * Unlike the per-service mock tests — which assert that the SDK sends whatever
 * the test author wrote — this test asserts the SDK matches the *spec*. It is the
 * check that would have caught the bulkcharge pause/resume POST-vs-GET bug.
 *
 * When Paystack changes their API: regenerate tests/SpecEndpoints.php from the
 * upstream spec, then make the services match.
 */

/**
 * Collapse path placeholders to a single `{}` token so spec placeholder names
 * ({id}, {code}, {reference}, …) and PHP interpolations ({$id}, {$code}, …)
 * compare equal.
 */
function normalizeEndpoint(string $verb, string $path): string
{
    $path = preg_replace('/\{[^}]*\}/', '{}', $path);

    return strtoupper($verb) . ' ' . $path;
}

/**
 * Endpoints produced via dynamic path construction (not a string literal in the
 * send() call), which the static scanner cannot see. Keep this list tiny and
 * justified — each entry is a deliberate escape hatch.
 */
function dynamicEndpoints(): array
{
    return [
        // Subscriptions::toggle() → sprintf('/subscription/%s', $active ? 'enable' : 'disable')
        'POST /subscription/enable',
        'POST /subscription/disable',
    ];
}

/**
 * Extract every literal verb+path the SDK can call, normalized.
 *
 * @return string[]
 */
function packageEndpoints(): array
{
    $found = dynamicEndpoints();

    $dir = new RecursiveDirectoryIterator(__DIR__ . '/../../src/Services');
    foreach (new RecursiveIteratorIterator($dir) as $file) {
        if ($file->getExtension() !== 'php') {
            continue;
        }

        $code = file_get_contents($file->getPathname());

        // ->send('VERB', '/literal/path' | "/literal/path") — ignores calls
        // whose path is a variable (e.g. send('POST', $endpoint, …)).
        preg_match_all(
            '/->send\(\s*[\'"](GET|POST|PUT|DELETE|PATCH)[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]/',
            $code,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as [$_, $verb, $path]) {
            $found[] = normalizeEndpoint($verb, $path);
        }
    }

    return array_values(array_unique($found));
}

/**
 * The canonical spec list, normalized.
 *
 * @return string[]
 */
function specEndpoints(): array
{
    $raw = require __DIR__ . '/../SpecEndpoints.php';

    return array_values(array_unique(array_map(function (string $entry) {
        [$verb, $path] = explode(' ', $entry, 2);

        return normalizeEndpoint($verb, $path);
    }, $raw)));
}

it('implements no endpoint absent from the Paystack spec (no wrong verbs or typos)', function () {
    $extra = array_diff(packageEndpoints(), specEndpoints());

    sort($extra);

    expect($extra)->toBe([], 'These SDK calls do not match any spec endpoint: ' . implode(', ', $extra));
});

it('covers every endpoint defined in the Paystack spec (no gaps)', function () {
    $missing = array_diff(specEndpoints(), packageEndpoints());

    sort($missing);

    expect($missing)->toBe([], 'These spec endpoints are not implemented: ' . implode(', ', $missing));
});

it('parsed a sane number of endpoints from both sides', function () {
    expect(count(specEndpoints()))->toBeGreaterThan(150)
        ->and(count(packageEndpoints()))->toBeGreaterThan(150);
});
