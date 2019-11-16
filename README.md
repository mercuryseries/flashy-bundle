# Easy Flash Messages in Symfony

# Copyright
Inspired by [Jeffrey Way's Flash Package](https://github.com/laracasts/flash).

## Installation

### Video Tutorial

Coming soon...

### You like text ?

1. First, use [Composer](https://getcomposer.org/) to download the library:

`composer require mercuryseries/flashy-bundle`

2. Then add the **MercurySeriesFlashyBundle** to your application:

In Symfony < 4:

```php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new MercurySeries\FlashyBundle\MercurySeriesFlashyBundle(),
        // ...
    );
}
```

In Symfony 4 with Symfony Flex this will be done automatically for you.

## Usage

Once the bundle is installed, you can autowire a `FlashyNotifier` into any controller:

```php
// Method 1: via action arguments
public function create(FlashyNotifier $flashy)
{
    ...

    $flashy->success('Event created!', 'http://your-awesome-link.com');

    return $this->redirectToRoute('home');
}
```

```php
// Method 2: via constructor
public function __construct(FlashyNotifier $flashy)
{
    $this->flashy = $flashy;
}

public function create()
{
    ...

    $this->flashy->success('Event created!', 'http://your-awesome-link.com');

    return $this->redirectToRoute('home');
}
```

You may also do:

- `$flashy->info('Your Message', 'http://your-awesome-link.com')`
- `$flashy->success('Your Message', 'http://your-awesome-link.com')`
- `$flashy->error('Your Message', 'http://your-awesome-link.com')`
- `$flashy->warning('Your Message', 'http://your-awesome-link.com')`
- `$flashy->primary('Your Message', 'http://your-awesome-link.com')`
- `$flashy->primaryDark('Your Message', 'http://your-awesome-link.com')`
- `$flashy->muted('Your Message', 'http://your-awesome-link.com')`
- `$flashy->mutedDark('Your Message', 'http://your-awesome-link.com')`

This will set a few keys in the session:

- 'mercuryseries_flashy_notification.message' - The message you're flashing
- 'mercuryseries_flashy_notification.type' - A string that represents the type of notification (good for applying HTML class names)
- 'mercuryseries_flashy_notification.link' - The URL to redirect to on click

With this message flashed to the session, you may now display it in your view(s) by including the partial `@MercurySeriesFlashy/flashy.html.twig`: 

## Example

```twig
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Awesome Website</title>
</head>
<body>

<div class="container">
    <p>Welcome to my website...</p>
</div>

<script src="//code.jquery.com/jquery.js"></script>
{{ include('@MercurySeriesFlashy/flashy.html.twig') }}
</body>
</html>
```

> Note that this bundle has jQuery as dependency. It's also better to load flashy before your body close tag.

If you need to modify the default flash message partial, you can create a `bundles/MercurySeriesFlashyBundle/flashy.html.twig` in your `templates` folder.

The default content of `@MercurySeriesFlashy/flashy.html.twig` is:


```twig
{% for message in app.flashes('mercuryseries_flashy_notification') %}
    <script id="flashy-template" type="text/template">
        <div class="flashy flashy--{{ message.type }}">
            <a class="flashy__body" href="#" target="_blank"></a>
        </div>
    </script>

    <script>
        flashy("{{ message.message }}", "{{ message.link }}");
    </script>
{% endfor %}
```

## Basic CSS & JS for the default partial

The bundles comes with basic CSS & JS for the default partial so you can get started faster. Of course you can change them, use another ones or create your own partial.

```html
<link rel="stylesheet" href="{{ asset('bundles/mercuryseriesflashy/css/flashy.css') }}" type="text/css" media="all" />

<script src="{{ asset('bundles/mercuryseriesflashy/js/flashy.js') }}"></script>
```

> Again, note that this bundle has jQuery as dependency.

## Nice rendering

For a nice rendering you may include these lines in your head:

```html
<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>
```

and override the following sections of the default flashy view:

```twig
// public/bundles/mercuryseriesflashy/css/flashy.css
.flashy {
    font-family: "Source Sans Pro", Arial, sans-serif;
    ...
}

// templates/bundles/MercurySeriesFlashyBundle/flashy.html.twig
{% for message in app.flashes('mercuryseries_flashy_notification') %}
    <script id="flashy-template" type="text/template">
        <div class="flashy flashy--{{ message.type }}">
            <i class="material-icons">speaker_notes</i>
            <a class="flashy__body" href="#" target="_blank"></a>
        </div>
    </script>

    <script>
        flashy("{{ message.message }}", "{{ message.link }}");
    </script>
{% endfor %}
```

## Configuration

```yaml
mercuryseries_flashy:
    # The name to use as the flash message key in the session store
    flash_message_name:   mercuryseries_flashy_notification

    # The session store to use for storing flash messages
    session_flashbag_store: null
```