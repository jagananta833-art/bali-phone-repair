<label>{{ $titleLabel }}<input name="{{ $titleName }}" value="{{ old($titleName, $item->{$titleName}) }}" required></label>
<label>Slug<input name="slug" value="{{ old('slug', $item->slug) }}"></label>
<label>Excerpt<textarea name="excerpt">{{ old('excerpt', $item->excerpt) }}</textarea></label>
<label>Content (HTML allowed)<textarea name="content" required>{{ old('content', $item->content) }}</textarea></label>
<label>SEO title<input name="meta_title" value="{{ old('meta_title', $item->meta_title) }}"></label>
<label>Meta description<textarea name="meta_description">{{ old('meta_description', $item->meta_description) }}</textarea></label>
<label>Focus keyword<input name="focus_keyword" value="{{ old('focus_keyword', $item->focus_keyword) }}"></label>
<label class="check"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published ?? true) ? 'checked' : '' }}> Published</label>
<button class="btn">Save</button>
