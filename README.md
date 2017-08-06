# Video Embedder plugin for Craft CMS 3.x

Craft plugin to generate an embed URL from a YouTube or Vimeo URL.

Ported over from [Viget's](https://viget.com) [Video Embed plugin for Craft 2.x](https://github.com/vigetlabs/craft-videoembed).

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install Video Embedder, follow these steps:

1. Install with Composer via `composer require mikestecker/craft3-videoembedder` from your project directory
2. Install plugin in the Craft Control Panel under Settings > Plugins

Video Embedder works on Craft 3.x.

## Video Embedder Overview

Video Embedder will take your YouTube or Vimeo URL's and convert the URL into an embed-friendly URL for use inside an iframe tag. Video Embedder also has a variable which will take the same URL and get the thumbnail image URL.

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
* Add more thumbnail size options

Brought to you by [Mike Stecker](http://github.com/mikestecker)
