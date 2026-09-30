@extends('layouts.public')

@section('title', 'Device Repair Blog Bali | Bali Phone Repair')
@section('description', 'Repair guides for iPhone, Android, MacBook, laptops, battery, screen, software, water damage, and device care in Bali.')
@section('canonical', request()->fullUrl())

@section('content')
<main>
    <section class="section inner-hero">
        <div class="inner-wrap">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span aria-current="page">Blog</span>
            </nav>

            <p class="eyebrow">Repair guides</p>
            <h1>Device Repair Blog</h1>
            <p class="hero-text">
                Practical repair guides, troubleshooting tips, maintenance advice,
                and professional solutions for Apple, Android, Windows laptops, and other devices in Bali.
            </p>

            @if($categories->isNotEmpty())
                <div class="area-tags">
                    @foreach($categories as $category)
                        <span>{{ $category->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="section">
        <div class="inner-wrap">

            <div class="post-grid">
                @foreach($posts as $post)
                    <article class="inner-card post-card">
                        <p class="eyebrow">{{ $post->category?->name ?? 'Guide' }}</p>

                        <h2>
                            <a href="{{ route('posts.show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p>{{ $post->excerpt }}</p>

                        <a class="footer-emphasis"
                           href="{{ route('posts.show', $post) }}">
                            Read guide →
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $posts->links() }}
            </div>

        </div>
    </section>
</main>

@push('schema')
@php
$collectionSchema=[
'@'.'context'=>'https://schema.org',
'@'.'type'=>'CollectionPage',
'name'=>'Device Repair Blog',
'url'=>request()->fullUrl(),
'mainEntity'=>[
'@'.'type'=>'ItemList',
'itemListElement'=>$posts->values()->map(fn($p,$i)=>[
'@'.'type'=>'ListItem',
'position'=>$i+1,
'url'=>route('posts.show',$p),
'name'=>$p->title,
])->all(),
],
];
$breadcrumbSchema=[
'@'.'context'=>'https://schema.org',
'@'.'type'=>'BreadcrumbList',
'itemListElement'=>[
['@'.'type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],
['@'.'type'=>'ListItem','position'=>2,'name'=>'Blog','item'=>route('blog')],
]
];
@endphp

<script type="application/ld+json">{!! json_encode($collectionSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endsection
