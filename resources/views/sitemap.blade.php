<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1</priority>
    </url>

    <url>
        <loc>{{ url('coupons') }}</loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ url('featured') }}</loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ url('discounts') }}</loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ url('offers') }}</loc>
        <priority>0.8</priority>
    </url>

  {{--  @foreach($products as $product)
        <url>
            <loc>{{ $product->product_slug }}</loc>
            <lastmod>{{ ($product->updated_at) ? $product->updated_at->toAtomString() : '' }}</lastmod>
            <priority>0.9</priority>
        </url>
    @endforeach

    @foreach($categories as $category)
        <url>
            <loc>https://sohojbazaar.com/category/{{ $category->category_slug }}</loc>
            <lastmod>{{ ($category->updated_at) ? $category->updated_at->toAtomString() : '' }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach--}}

    <url>
        <loc>{{ url('contact-us') }}</loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ url('about-us') }}</loc>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ url('privacy-policy') }}</loc>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ url('shipping-and-delivery') }}</loc>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ url('terms-of-use') }}</loc>
        <priority>0.7</priority>
    </url>
</urlset>
