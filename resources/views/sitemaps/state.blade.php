<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($states as $state)
        <url>
            <loc>{{url(strtolower($state['country']['abv3']).'/'.strtolower($state['abv']))}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($state->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>