<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($cities as $city)
        <url>
            <loc>{{url(strtolower($city['state']['country']['abv3'].'/'.$city['state']['abv'].'/'.$city->slug))}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($city->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>