<label for="parent_id">Select Category Level</label>
<select name="parent_id" id="parent_id" class="form-control select2 @error('parent_id') is-invalid @enderror" style="width: 100%;">
    <option value="0" {{ old('parent_id', $category->parent_id ?? 0) == 0 ? 'selected' : '' }}>Main Category</option>
    
    @if (!empty($getCategories))
        @foreach ($getCategories as $parentCategory)
            <option value="{{ $parentCategory->id }}" {{ old('parent_id', $category->parent_id ?? '') == $parentCategory->id ? 'selected' : '' }}>
                {{ $parentCategory->category_name }}
            </option>
            @if (!empty($parentCategory->subcategories))
                @foreach ($parentCategory->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ old('parent_id', $category->parent_id ?? '') == $subcategory->id ? 'selected' : '' }}>
                        &nbsp;&raquo;&nbsp;{{ $subcategory->category_name }}
                    </option>
                @endforeach
            @endif
        @endforeach
    @endif
</select>

@error('parent_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror