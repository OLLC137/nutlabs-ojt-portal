
<section class="company-search-card-area">
    @foreach ($categories as $category)
        <div class="company-search-card" wire:click="cardClick('{{ $category->cat_name }}')">
            <img src="{{ asset($category->cat_icon) }}" alt="{{ $category->cat_name }}">
            <h4>{{ $category->cat_name }}</h4>
            <p>{{$category->count}} Listings</p>
        </div>
    @endforeach
</section>
