<?php
declare(strict_types=1);

const EXAMPLES_DIR = __DIR__ . '/../examples';

const ALLOWED_FILES = [
    'README.md',
    'input.md',
    'research.md',
    'board.md',
    'campaign.md',
    'scenes.md',
    'output-thread.md',
    'output-newsletter.md',
];

const TABS = [
    'overview'     => ['label' => 'Overview',    'file' => 'README.md'],
    'input'        => ['label' => 'Input',       'file' => 'input.md'],
    'research'     => ['label' => 'Research',    'file' => 'research.md'],
    'board'        => ['label' => 'Board',       'file' => 'board.md'],
    'campaign'     => ['label' => 'Campaign',    'file' => 'campaign.md'],
    'scenes'       => ['label' => 'Scenes',      'file' => 'scenes.md'],
    'x-thread'     => ['label' => 'X Thread',    'file' => 'output-thread.md'],
    'newsletter'   => ['label' => 'Newsletter',  'file' => 'output-newsletter.md'],
];

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function isValidExampleSlug(string $slug): bool
{
    return $slug !== '' && (bool) preg_match('/^[a-z0-9][a-z0-9\-]*$/', $slug);
}

function resolveExamplePath(string $slug): ?string
{
    if (!isValidExampleSlug($slug)) {
        return null;
    }

    $base = realpath(EXAMPLES_DIR);
    if ($base === false) {
        return null;
    }

    $candidate = $base . DIRECTORY_SEPARATOR . $slug;
    $resolved = realpath($candidate);

    if ($resolved === false || !is_dir($resolved)) {
        return null;
    }

    if (!str_starts_with($resolved, $base . DIRECTORY_SEPARATOR) && $resolved !== $base) {
        return null;
    }

    return $resolved;
}

function resolveExampleFile(string $examplePath, string $filename): ?string
{
    if (!in_array($filename, ALLOWED_FILES, true)) {
        return null;
    }

    $candidate = $examplePath . DIRECTORY_SEPARATOR . $filename;
    $resolved = realpath($candidate);

    if ($resolved === false || !is_file($resolved)) {
        return null;
    }

    if (!str_starts_with($resolved, $examplePath . DIRECTORY_SEPARATOR)) {
        return null;
    }

    return $resolved;
}

function listExamples(): array
{
    if (!is_dir(EXAMPLES_DIR)) {
        return [];
    }

    $examples = [];
    $entries = scandir(EXAMPLES_DIR);
    if ($entries === false) {
        return [];
    }

    foreach ($entries as $entry) {
        if ($entry === '.' || $entry === '..' || $entry === 'README.md') {
            continue;
        }

        $path = EXAMPLES_DIR . DIRECTORY_SEPARATOR . $entry;
        if (is_dir($path) && isValidExampleSlug($entry)) {
            $examples[] = $entry;
        }
    }

    sort($examples, SORT_NATURAL | SORT_FLAG_CASE);
    return $examples;
}

function sanitizeUrl(string $url): ?string
{
    $url = trim($url);
    if ($url === '') {
        return null;
    }

    if (preg_match('/^(https?:\/\/|mailto:)/i', $url) !== 1) {
        return null;
    }

    return $url;
}

function renderOpinionPlaceholder(string $text): string
{
    $pattern = '/\[MY SUPER BASED OPINION\]/i';
    $replacement = '<div class="opinion-placeholder" role="note">'
        . '<span class="opinion-label">Editorial placeholder</span>'
        . '<span class="opinion-text">[MY SUPER BASED OPINION]</span>'
        . '</div>';

    return preg_replace($pattern, $replacement, $text) ?? $text;
}

function renderInlineMarkdown(string $text): string
{
    $text = renderOpinionPlaceholder($text);

    $text = preg_replace('/`([^`]+)`/', '<code>$1</code>', $text) ?? $text;
    $text = preg_replace('/\*\*([^*]+)\*\*/', '<strong>$1</strong>', $text) ?? $text;
    $text = preg_replace('/\*([^*]+)\*/', '<em>$1</em>', $text) ?? $text;

    $text = preg_replace_callback(
        '/\[([^\]]+)\]\(([^)]+)\)/',
        static function (array $matches): string {
            $label = $matches[1];
            $url = sanitizeUrl(html_entity_decode($matches[2], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            if ($url === null) {
                return $matches[0];
            }
            return '<a href="' . h($url) . '" rel="noopener noreferrer">' . $label . '</a>';
        },
        $text
    ) ?? $text;

    return $text;
}

function renderMarkdown(string $markdown): string
{
    $lines = preg_split('/\R/', $markdown) ?: [];
    $html = [];
    $paragraph = [];
    $listItems = [];
    $inCode = false;
    $codeLines = [];

    $flushParagraph = static function () use (&$html, &$paragraph): void {
        if ($paragraph === []) {
            return;
        }
        $text = trim(implode("\n", $paragraph));
        if ($text !== '') {
            $html[] = '<p>' . renderInlineMarkdown(h($text)) . '</p>';
        }
        $paragraph = [];
    };

    $flushList = static function () use (&$html, &$listItems): void {
        if ($listItems === []) {
            return;
        }
        $html[] = '<ul>' . implode('', $listItems) . '</ul>';
        $listItems = [];
    };

    foreach ($lines as $line) {
        if (preg_match('/^```/', $line) === 1) {
            $flushParagraph();
            $flushList();
            if ($inCode) {
                $html[] = '<pre><code>' . h(implode("\n", $codeLines)) . '</code></pre>';
                $codeLines = [];
                $inCode = false;
            } else {
                $inCode = true;
            }
            continue;
        }

        if ($inCode) {
            $codeLines[] = $line;
            continue;
        }

        if (trim($line) === '---') {
            $flushParagraph();
            $flushList();
            $html[] = '<hr>';
            continue;
        }

        if (preg_match('/^(#{1,6})\s+(.+)$/', $line, $matches) === 1) {
            $flushParagraph();
            $flushList();
            $level = strlen($matches[1]);
            $html[] = '<h' . $level . '>' . renderInlineMarkdown(h(trim($matches[2]))) . '</h' . $level . '>';
            continue;
        }

        if (preg_match('/^>\s?(.*)$/', $line, $matches) === 1) {
            $flushParagraph();
            $flushList();
            $html[] = '<blockquote><p>' . renderInlineMarkdown(h(trim($matches[1]))) . '</p></blockquote>';
            continue;
        }

        if (preg_match('/^[-*]\s+(.+)$/', $line, $matches) === 1) {
            $flushParagraph();
            $listItems[] = '<li>' . renderInlineMarkdown(h(trim($matches[1]))) . '</li>';
            continue;
        }

        if (preg_match('/^\d+\.\s+(.+)$/', $line, $matches) === 1) {
            $flushParagraph();
            $listItems[] = '<li>' . renderInlineMarkdown(h(trim($matches[1]))) . '</li>';
            continue;
        }

        if (trim($line) === '') {
            $flushParagraph();
            $flushList();
            continue;
        }

        $flushList();
        $paragraph[] = $line;
    }

    if ($inCode) {
        $html[] = '<pre><code>' . h(implode("\n", $codeLines)) . '</code></pre>';
    }

    $flushParagraph();
    $flushList();

    return implode("\n", $html);
}

function extractThreadPosts(string $markdown): array
{
    $pattern = '/^##\s+(POST\s+\d+(?::\s*.+)?|FINAL POST(?::\s*.+)?)\s*$/mi';
    if (preg_match_all($pattern, $markdown, $matches, PREG_OFFSET_CAPTURE) < 1) {
        return [];
    }

    $posts = [];
    $count = count($matches[0]);

    for ($i = 0; $i < $count; $i++) {
        $heading = trim($matches[1][$i][0]);
        $start = $matches[0][$i][1] + strlen($matches[0][$i][0]);
        $end = ($i + 1 < $count) ? $matches[0][$i + 1][1] : strlen($markdown);
        $body = trim(substr($markdown, $start, $end - $start));
        $posts[] = [
            'heading' => $heading,
            'body' => $body,
        ];
    }

    return $posts;
}

function renderThread(string $markdown): string
{
    $parts = preg_split('/^---\s*$/m', $markdown, 2);
    $preamble = isset($parts[0]) ? trim($parts[0]) : '';
    $body = isset($parts[1]) ? trim($parts[1]) : $markdown;

    $html = [];
    if ($preamble !== '') {
        $html[] = '<div class="doc-preamble">' . renderMarkdown($preamble) . '</div>';
    }

    $posts = extractThreadPosts($body);
    if ($posts === []) {
        $html[] = '<div class="markdown-body">' . renderMarkdown($body) . '</div>';
        return implode("\n", $html);
    }

    $html[] = '<div class="thread-grid">';
    foreach ($posts as $index => $post) {
        $isFinal = stripos($post['heading'], 'FINAL POST') !== false;
        $cardClass = 'thread-card' . ($isFinal ? ' thread-card--final' : '');
        $label = $isFinal ? 'Final Post' : 'Post ' . ($index + 1);

        $html[] = '<article class="' . $cardClass . '">';
        $html[] = '<header class="thread-card__header">';
        $html[] = '<span class="thread-card__badge">' . h($label) . '</span>';
        $html[] = '<h3 class="thread-card__title">' . renderInlineMarkdown(h($post['heading'])) . '</h3>';
        $html[] = '</header>';
        $html[] = '<div class="thread-card__body markdown-body">' . renderMarkdown($post['body']) . '</div>';
        $html[] = '</article>';
    }
    $html[] = '</div>';

    return implode("\n", $html);
}

function extractNewsletterSubject(string $markdown): ?string
{
    if (preg_match('/^\*\*Subject:\s*(.+?)\*\*\s*$/mi', $markdown, $matches) === 1) {
        return trim($matches[1]);
    }
    return null;
}

function renderNewsletter(string $markdown): string
{
    $subject = extractNewsletterSubject($markdown);
    $parts = preg_split('/^---\s*$/m', $markdown, 2);
    $preamble = isset($parts[0]) ? trim($parts[0]) : '';
    $body = isset($parts[1]) ? trim($parts[1]) : $markdown;

    $html = ['<article class="newsletter-article">'];

    if ($subject !== null) {
        $html[] = '<header class="newsletter-hero">';
        $html[] = '<p class="newsletter-kicker">Newsletter output</p>';
        $html[] = '<h2 class="newsletter-subject">' . h($subject) . '</h2>';
        $html[] = '</header>';
    }

    if ($preamble !== '') {
        $html[] = '<div class="doc-preamble newsletter-meta">' . renderMarkdown($preamble) . '</div>';
    }

    $sections = preg_split('/^##\s+/m', $body) ?: [];
    array_shift($sections);

    $html[] = '<div class="newsletter-sections">';
    foreach ($sections as $section) {
        $section = trim($section);
        if ($section === '') {
            continue;
        }

        $lines = preg_split('/\R/', $section, 2);
        $title = trim($lines[0] ?? '');
        $content = trim($lines[1] ?? '');
        $isBoard = stripos($title, 'BOARD STATE') !== false;
        $sectionClass = 'newsletter-section' . ($isBoard ? ' newsletter-section--board' : '');

        $html[] = '<section class="' . $sectionClass . '">';
        $html[] = '<h3 class="newsletter-section__title">' . renderInlineMarkdown(h($title)) . '</h3>';
        $html[] = '<div class="newsletter-section__body markdown-body">' . renderMarkdown($content) . '</div>';
        $html[] = '</section>';
    }
    $html[] = '</div>';
    $html[] = '</article>';

    return implode("\n", $html);
}

function renderContent(string $markdown, string $tab): string
{
    return match ($tab) {
        'x-thread' => renderThread($markdown),
        'newsletter' => renderNewsletter($markdown),
        default => '<div class="markdown-body">' . renderMarkdown($markdown) . '</div>',
    };
}

function tabHasFile(string $examplePath, string $tabKey): bool
{
    $filename = TABS[$tabKey]['file'] ?? null;
    if ($filename === null) {
        return false;
    }
    return resolveExampleFile($examplePath, $filename) !== null;
}

$examples = listExamples();
$exampleSlug = isset($_GET['example']) ? (string) $_GET['example'] : '';
$tab = isset($_GET['tab']) ? (string) $_GET['tab'] : 'overview';

if (!array_key_exists($tab, TABS)) {
    $tab = 'overview';
}

if ($exampleSlug === '' && $examples !== []) {
    $exampleSlug = $examples[0];
}

$examplePath = $exampleSlug !== '' ? resolveExamplePath($exampleSlug) : null;
$activeFile = TABS[$tab]['file'];
$filePath = ($examplePath !== null) ? resolveExampleFile($examplePath, $activeFile) : null;
$markdown = null;
$error = null;

if ($exampleSlug !== '' && $examplePath === null) {
    $error = 'Example not found or access denied.';
} elseif ($examplePath !== null && $filePath === null) {
    $error = 'This file is not available for the selected example yet.';
} elseif ($filePath !== null) {
    $contents = file_get_contents($filePath);
    if ($contents === false) {
        $error = 'Unable to read the requested file.';
    } else {
        $markdown = $contents;
    }
}

$pageTitle = 'POV Campaign Engine Viewer';
if ($exampleSlug !== '' && $examplePath !== null) {
    $pageTitle = str_replace('-', ' ', $exampleSlug) . ' — ' . TABS[$tab]['label'];
}

$downloadName = $exampleSlug !== '' ? $exampleSlug . '-' . $tab . '.md' : 'document.md';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="app-shell">
        <header class="site-header">
            <div class="brand">
                <p class="brand-eyebrow">POV Campaign Engine</p>
                <h1 class="brand-title">Incident Dossier Viewer</h1>
            </div>
            <p class="brand-copy">Browse verified pipeline artifacts and rendered outputs without a database or build step.</p>
        </header>

        <main class="layout">
            <aside class="sidebar">
                <div class="panel">
                    <h2 class="panel-title">Examples</h2>
                    <?php if ($examples === []): ?>
                        <p class="empty-state">No example folders found in <code>examples/</code>.</p>
                    <?php else: ?>
                        <nav class="example-list" aria-label="Examples">
                            <?php foreach ($examples as $slug): ?>
                                <?php $isActive = $slug === $exampleSlug; ?>
                                <a
                                    class="example-link<?= $isActive ? ' is-active' : '' ?>"
                                    href="?example=<?= h(urlencode($slug)) ?>&amp;tab=<?= h(urlencode($tab)) ?>"
                                ><?= h(str_replace('-', ' ', $slug)) ?></a>
                            <?php endforeach; ?>
                        </nav>
                    <?php endif; ?>
                </div>
            </aside>

            <section class="content-area">
                <?php if ($examples === []): ?>
                    <div class="alert alert--warning">
                        <h2>No examples available</h2>
                        <p>Upload or add event folders under <code>examples/</code> to populate the viewer.</p>
                    </div>
                <?php elseif ($error !== null): ?>
                    <div class="alert alert--warning">
                        <h2>Unavailable</h2>
                        <p><?= h($error) ?></p>
                        <?php if ($examplePath !== null): ?>
                            <p class="alert-meta">Example: <strong><?= h($exampleSlug) ?></strong> · Tab: <strong><?= h(TABS[$tab]['label']) ?></strong></p>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="content-toolbar">
                        <div class="toolbar-meta">
                            <p class="case-label">Active dossier</p>
                            <h2 class="case-title"><?= h(str_replace('-', ' ', $exampleSlug)) ?></h2>
                        </div>
                        <div class="toolbar-actions">
                            <button type="button" class="btn btn--ghost" id="copy-markdown">Copy Markdown</button>
                            <textarea id="markdown-source" hidden readonly><?= h($markdown ?? '') ?></textarea>
                            <a
                                class="btn btn--primary"
                                id="download-markdown"
                                href="data:text/markdown;charset=utf-8,<?= rawurlencode($markdown ?? '') ?>"
                                download="<?= h($downloadName) ?>"
                            >Download Markdown</a>
                        </div>
                    </div>

                    <nav class="tab-bar" aria-label="Document tabs">
                        <?php foreach (TABS as $tabKey => $tabInfo): ?>
                            <?php
                            $available = ($examplePath !== null) && tabHasFile($examplePath, $tabKey);
                            $isCurrent = $tabKey === $tab;
                            ?>
                            <?php if ($available): ?>
                                <a
                                    class="tab-link<?= $isCurrent ? ' is-active' : '' ?>"
                                    href="?example=<?= h(urlencode($exampleSlug)) ?>&amp;tab=<?= h(urlencode($tabKey)) ?>"
                                ><?= h($tabInfo['label']) ?></a>
                            <?php else: ?>
                                <span class="tab-link is-disabled" aria-disabled="true"><?= h($tabInfo['label']) ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </nav>

                    <article class="document-panel">
                        <header class="document-header">
                            <p class="document-stage">Pipeline stage</p>
                            <h3 class="document-title"><?= h(TABS[$tab]['label']) ?></h3>
                            <p class="document-file"><code><?= h($activeFile) ?></code></p>
                        </header>
                        <div class="document-content">
                            <?= renderContent($markdown ?? '', $tab) ?>
                        </div>
                    </article>
                <?php endif; ?>
            </section>
        </main>

        <footer class="site-footer">
            <p>Read-only viewer · PHP <?= h(PHP_VERSION) ?> · Files served from <code>examples/</code></p>
        </footer>
    </div>

    <div class="toast" id="toast" role="status" aria-live="polite"></div>

    <script>
    (function () {
        var copyButton = document.getElementById('copy-markdown');
        var markdownSource = document.getElementById('markdown-source');
        var toast = document.getElementById('toast');

        function showToast(message) {
            if (!toast) return;
            toast.textContent = message;
            toast.classList.add('is-visible');
            window.setTimeout(function () {
                toast.classList.remove('is-visible');
            }, 2200);
        }

        if (copyButton) {
            copyButton.addEventListener('click', function () {
                var markdown = markdownSource ? markdownSource.value : '';
                if (!markdown) {
                    showToast('Nothing to copy.');
                    return;
                }

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(markdown).then(function () {
                        showToast('Markdown copied to clipboard.');
                    }).catch(function () {
                        fallbackCopy(markdown);
                    });
                } else {
                    fallbackCopy(markdown);
                }
            });
        }

        function fallbackCopy(text) {
            var area = document.createElement('textarea');
            area.value = text;
            area.setAttribute('readonly', '');
            area.style.position = 'fixed';
            area.style.left = '-9999px';
            document.body.appendChild(area);
            area.select();
            try {
                document.execCommand('copy');
                showToast('Markdown copied to clipboard.');
            } catch (error) {
                showToast('Copy failed in this browser.');
            }
            document.body.removeChild(area);
        }
    })();
    </script>
</body>
</html>
