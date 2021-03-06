{{ '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' }}
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title><![CDATA[{{ $channel['title'] }}]]></title>
        <link>{{ Request::url() }}</link>
        <description>{{ $channel['description'] }}</description>
        <atom:link href="{{ $channel['link'] }}" rel="self"></atom:link>
        @if (!empty($channel['logo']))
            <image>
                <url>{{ $channel['logo'] }}</url>
                <title>{{ $channel['title'] }}</title>
                <link>{{ Request::url() }}</link>
            </image>
        @endif
        <language>{{ $channel['lang'] }}</language>
        <lastBuildDate>{{ $channel['pubdate'] }}</lastBuildDate>
        @foreach($items as $item)
            <item>
                <title>{{ $item->title }}</title>
                <link>{{ route('items.show', $item->slug) }}</link>
                <guid isPermaLink="true">{{ route('items.show', $item->slug) }}</guid>
                <description>{{ $item->description }}</description>
                @if (!empty($item['content']))
                    <content:encoded><![CDATA[{{ $item->description }}]]></content:encoded>
                @endif
                <dc:creator xmlns:dc="http://purl.org/dc/elements/1.1/">{{ $item->seller_name }}</dc:creator>
                <pubDate>{{ $item->updated_at->toDayDateTimeString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>