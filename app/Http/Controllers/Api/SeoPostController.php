<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\IndexNowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeoPostController extends Controller
{
    /**
     * Memvalidasi API key dari header Bearer Token.
     */
    protected function authorizeRequest(Request $request): ?JsonResponse
    {
        $configuredKey = config('services.seo_tools.api_key') ?: env('SEO_TOOLS_API_KEY');

        // Jika API key belum diset di .env, izinkan untuk mempermudah konfigurasi awal,
        // namun jika sudah diset, wajib valid.
        if (!empty($configuredKey)) {
            $bearerToken = $request->bearerToken();
            if (!$bearerToken || !hash_equals((string) $configuredKey, (string) $bearerToken)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: API key tidak valid.',
                ], 401);
            }
        }

        return null;
    }

    /**
     * Endpoint ping / test koneksi untuk dashboard tools SEO & GEO.
     */
    public function ping(Request $request): JsonResponse
    {
        if ($authError = $this->authorizeRequest($request)) {
            return $authError;
        }

        return response()->json([
            'success' => true,
            'message' => 'Koneksi berhasil',
            'site' => config('app.name', 'Bali Phone Repair'),
            'status' => 'ok',
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * Menerima dan menyimpan artikel otomatis dari SEO/GEO tools.
     */
    public function store(Request $request): JsonResponse
    {
        if ($authError = $this->authorizeRequest($request)) {
            return $authError;
        }

        $titleInput = $request->input('title');
        $title = is_array($titleInput) ? ($titleInput['rendered'] ?? '') : (string) $titleInput;

        if (empty(trim($title))) {
            return response()->json([
                'success' => false,
                'message' => 'Field title wajib diisi.',
            ], 422);
        }

        $contentInput = $request->input('content');
        $content = is_array($contentInput) ? ($contentInput['rendered'] ?? '') : (string) $contentInput;

        $excerptInput = $request->input('excerpt');
        $excerpt = is_array($excerptInput) ? ($excerptInput['rendered'] ?? '') : (string) $excerptInput;
        if (empty(trim($excerpt))) {
            $excerpt = Str::limit(strip_tags($content), 160, '...');
        }

        // Penanganan slug unik & pencegahan duplikasi massal
        $baseSlug = $request->filled('slug')
            ? Str::slug((string) $request->input('slug'))
            : Str::slug($title);

        // Cari apakah artikel dengan slug dasar atau judul yang sama sudah ada
        $existingPost = Post::where('slug', $baseSlug)
            ->orWhere('title', $title)
            ->first();

        // Penanganan Kategori
        $categoryId = null;
        if ($request->filled('category')) {
            $categoryName = trim((string) $request->input('category'));
            $category = Category::where('name', $categoryName)
                ->orWhere('slug', Str::slug($categoryName))
                ->first();

            if (!$category) {
                $category = Category::create([
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                    'description' => 'Kategori artikel ' . $categoryName,
                ]);
            }
            $categoryId = $category->id;
        } else {
            $categoryId = $existingPost ? $existingPost->category_id : Category::value('id');
        }

        // Penanganan Author
        $userId = User::value('id');
        $authorName = $request->input('author_name') ?? $request->input('author') ?? ($existingPost ? $existingPost->author_name : 'Bali Phone Repair Team');

        // Keywords / Focus Keyword
        $keywordsInput = $request->input('keywords') ?? $request->input('tags') ?? $request->input('focus_keyword');
        $focusKeyword = is_array($keywordsInput) ? implode(', ', $keywordsInput) : (string) $keywordsInput;
        if (empty($focusKeyword) && $existingPost) {
            $focusKeyword = $existingPost->focus_keyword;
        }

        // Image
        $featuredImage = $request->input('image_url') ?? $request->input('featured_image') ?? ($existingPost ? $existingPost->featured_image : null);

        // Status & Published At
        $status = strtolower((string) $request->input('status', 'published'));
        $isPublished = in_array($status, ['published', 'publish', '1', 'true'], true);

        $publishedAtRaw = $request->input('published_at') ?? $request->input('date');
        $publishedAt = $isPublished
            ? ($publishedAtRaw ? date('Y-m-d H:i:s', strtotime((string) $publishedAtRaw)) : ($existingPost?->published_at ?: now()))
            : null;

        $metaTitle = $request->input('meta_title') ?: Str::limit($title, 60, '');
        $metaDescription = $request->input('meta_description') ?: Str::limit(strip_tags($excerpt), 160, '');

        if ($existingPost) {
            // Update postingan yang sudah ada agar tidak terjadi kanibalisasi duplikat
            $existingPost->update([
                'category_id' => $categoryId,
                'user_id' => $userId,
                'author_name' => $authorName,
                'title' => $title,
                'excerpt' => $excerpt,
                'content' => $content,
                'featured_image' => $featuredImage,
                'featured_image_alt' => $title,
                'meta_title' => $metaTitle,
                'meta_description' => $metaDescription,
                'focus_keyword' => $focusKeyword,
                'is_published' => $isPublished,
                'published_at' => $publishedAt,
            ]);
            $post = $existingPost;
            $message = 'Artikel yang sudah ada berhasil diperbarui.';
        } else {
            // Buat postingan baru
            $post = Post::create([
                'category_id' => $categoryId,
                'user_id' => $userId,
                'author_name' => $authorName,
                'title' => $title,
                'slug' => $baseSlug,
                'excerpt' => $excerpt,
                'content' => $content,
                'featured_image' => $featuredImage,
                'featured_image_alt' => $title,
                'meta_title' => $metaTitle,
                'meta_description' => $metaDescription,
                'focus_keyword' => $focusKeyword,
                'is_published' => $isPublished,
                'published_at' => $publishedAt,
            ]);
            $message = 'Artikel baru berhasil dipublikasikan.';
        }

        $postUrl = route('posts.show', $post->slug);

        // Push URL ke Bing & ChatGPT Search via IndexNow
        IndexNowService::ping($postUrl);

        return response()->json([
            'success' => true,
            'id' => $post->id,
            'post_id' => $post->id,
            'url' => $postUrl,
            'post_url' => $postUrl,
            'message' => $message,
        ], 200);
    }

    /**
     * Memperbarui artikel yang sudah ada.
     */
    public function update(Request $request, $id): JsonResponse
    {
        if ($authError = $this->authorizeRequest($request)) {
            return $authError;
        }

        $post = Post::find($id) ?: Post::where('slug', $id)->first();
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan.',
            ], 404);
        }

        $data = [];
        if ($request->filled('title')) {
            $data['title'] = (string) $request->input('title');
        }
        if ($request->filled('content')) {
            $data['content'] = (string) $request->input('content');
        }
        if ($request->filled('excerpt')) {
            $data['excerpt'] = (string) $request->input('excerpt');
        }
        if ($request->filled('meta_title')) {
            $data['meta_title'] = (string) $request->input('meta_title');
        }
        if ($request->filled('meta_description')) {
            $data['meta_description'] = (string) $request->input('meta_description');
        }
        if ($request->filled('focus_keyword')) {
            $data['focus_keyword'] = (string) $request->input('focus_keyword');
        }
        if ($request->filled('author_name') || $request->filled('author')) {
            $data['author_name'] = $request->input('author_name') ?? $request->input('author');
        }
        if ($request->filled('image_url') || $request->filled('featured_image')) {
            $data['featured_image'] = $request->input('image_url') ?? $request->input('featured_image');
        }

        if (!empty($data)) {
            $post->update($data);
        }

        $postUrl = route('posts.show', $post->slug);

        // Push URL ke Bing & ChatGPT Search via IndexNow
        IndexNowService::ping($postUrl);

        return response()->json([
            'success' => true,
            'id' => $post->id,
            'post_id' => $post->id,
            'url' => $postUrl,
            'post_url' => $postUrl,
            'message' => 'Artikel berhasil diperbarui.',
        ]);
    }
}
