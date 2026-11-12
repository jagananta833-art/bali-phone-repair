# Bali Phone Repair - Search & Crawler Policy
# Authorized search indexers allowed; scrapers & cloners restricted

User-agent: OAI-SearchBot
Allow: /

User-agent: Bingbot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: Googlebot
Allow: /

User-agent: GPTBot
Allow: /

# Restrict aggressive scraping bots & mass cloners
User-agent: CCBot
Disallow: /

User-agent: Bytespider
Disallow: /

User-agent: Diffbot
Disallow: /

User-agent: ImagesiftBot
Disallow: /

User-agent: MegaIndex
Disallow: /

User-agent: Scrapy
Disallow: /

User-agent: Amazonbot
Disallow: /

User-agent: *
Allow: /
Disallow: /admin
Disallow: /login
Disallow: /renew-license

Sitemap: {{ route('sitemap') }}
