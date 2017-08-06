# Video Embedder plugin for Craft CMS 3.x

Craft plugin to generate an embed URL from a YouTube or Vimeo URL.

Ported over from [Viget's](https://viget.com) Craft 2.x [Video Embed plugin](https://github.com/vigetlabs/craft-videoembed).

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require mikestecker/video-embedder

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Video Embedder.

## Video Embedder Overview

-Insert text here-

## Using Video Embedder

Pass a YouTube or Vimeo URL to the `getEmbedUrl` variable and an embed URL will be returned.

```
{{ craft.videoEmbed.getEmbedUrl('https://www.youtube.com/watch?v=6xWpo5Dn254') }}
```

**Example:**

```
<iframe src="{{ craft.videoEmbed.getEmbedUrl('https://www.youtube.com/watch?v=6xWpo5Dn254') }}"></iframe>
```

**Output:**

```
<iframe src="//www.youtube.com/embed/6xWpo5Dn254"></iframe>
```

Video Embedder will also pull the largest thumbnail URL from YouTube or Vimeo using the `getVideoThumbnail` variable.

```
{{ craft.videoEmbed.getVideoThumbnail('https://www.youtube.com/watch?v=6xWpo5Dn254') }}
```

**Output:**

```
//img.youtube.com/vi/6xWpo5Dn254/0.jpg
```


## Video Embedder Roadmap

Some things to do, and ideas for potential features:

* Add in the ability to actually generate the iframe HTML
* Add new Video URL field type that only allows for supported video URL's
* Add support for more video providers

Brought to you by [Mike Stecker](http://github.com/mikestecker)
