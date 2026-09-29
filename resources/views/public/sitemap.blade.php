<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ url('/') }}</loc><changefreq>weekly</changefreq></url>
    <url><loc>{{ route('services.index') }}</loc><changefreq>weekly</changefreq></url>
    <url><loc>{{ route('areas.index') }}</loc><changefreq>monthly</changefreq></url>
    <url><loc>{{ route('blog') }}</loc><changefreq>weekly</changefreq></url>
    @foreach($services as $item)<url><loc>{{ route('services.show', $item) }}</loc><lastmod>{{ $item->updated_at->toAtomString() }}</lastmod></url>@endforeach
    @foreach($locations as $item)<url><loc>{{ route('locations.show', $item) }}</loc><lastmod>{{ $item->updated_at->toAtomString() }}</lastmod></url>@endforeach
    @foreach($pages as $item)<url><loc>{{ route('pages.show', $item) }}</loc><lastmod>{{ $item->updated_at->toAtomString() }}</lastmod></url>@endforeach
    @foreach($posts as $item)<url><loc>{{ route('posts.show', $item) }}</loc><lastmod>{{ $item->updated_at->toAtomString() }}</lastmod></url>@endforeach
</urlset>
