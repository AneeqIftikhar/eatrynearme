<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($restaurants as $listing)
        <url>
            <loc>{{url(strtolower($listing['city']['state']['country']['abv3']).'/'.strtolower($listing['city']['state']['abv'].'/'.$listing['city']['slug'].'/'.$listing['slug']))}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($listing->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>