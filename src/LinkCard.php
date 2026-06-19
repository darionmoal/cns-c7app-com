<?php

class LinkCard
{
    private string $url;
    private string $domain;
    private string $title;
    private string $description;
    private string $keyword;

    public function __construct(
        string $url = 'https://cns-c7app.com',
        string $keyword = 'c7c7.app',
        string $title = 'C7C7 App Platform',
        string $description = 'A modern application ecosystem for productivity and entertainment.'
    ) {
        $this->url = $url;
        $this->domain = parse_url($url, PHP_URL_HOST) ?: $url;
        $this->title = $title;
        $this->description = $description;
        $this->keyword = $keyword;
    }

    public function render(): string
    {
        $safeUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeDomain = htmlspecialchars($this->domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeKeyword = htmlspecialchars($this->keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return <<<HTML
<div class="link-card">
    <a href="{$safeUrl}" target="_blank" rel="noopener noreferrer" class="link-card-anchor">
        <div class="link-card-content">
            <span class="link-card-domain">{$safeDomain}</span>
            <h3 class="link-card-title">{$safeTitle}</h3>
            <p class="link-card-description">{$safeDesc}</p>
            <span class="link-card-keyword">Keyword: {$safeKeyword}</span>
        </div>
    </a>
</div>
HTML;
    }

    public static function createDefault(): self
    {
        return new self();
    }

    public static function createCustom(
        string $url,
        string $keyword,
        string $title = '',
        string $description = ''
    ): self {
        if (empty($title)) {
            $title = 'Custom Link';
        }
        if (empty($description)) {
            $description = 'Visit ' . $url . ' for more information.';
        }
        return new self($url, $keyword, $title, $description);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}

function render_link_card(
    string $url = 'https://cns-c7app.com',
    string $keyword = 'c7c7.app',
    string $title = 'C7C7 App Platform',
    string $description = 'A modern application ecosystem for productivity and entertainment.'
): string {
    $card = new LinkCard($url, $keyword, $title, $description);
    return $card->render();
}

function render_link_card_from_array(array $config): string
{
    $defaults = [
        'url' => 'https://cns-c7app.com',
        'keyword' => 'c7c7.app',
        'title' => 'C7C7 App Platform',
        'description' => 'A modern application ecosystem for productivity and entertainment.',
    ];
    $merged = array_merge($defaults, $config);
    return render_link_card(
        $merged['url'],
        $merged['keyword'],
        $merged['title'],
        $merged['description']
    );
}

// Example usage (uncomment to test):
// echo render_link_card();
// echo render_link_card_from_array(['title' => 'My Custom Card']);