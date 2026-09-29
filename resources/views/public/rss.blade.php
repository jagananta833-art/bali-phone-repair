<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Bali Phone Repair Blog</title>
        <link>{{ route('blog') }}</link>
        <description>Published repair guides from Bali Phone Repair.</description>
        @foreach($posts as $post)
            <item>
                <title>{{ $post->title }}</title>
                <link>{{ route('posts.show', $post) }}</link>
                <guid>{{ route('posts.show', $post) }}</guid>
                <description>{{ $post->excerpt }}</description>
                <pubDate>{{ optional($post->published_at)->toRfc2822String() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
