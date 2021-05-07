# Nice Flash Messages in Symfony

![Example of Error Notification](https://i.imgur.com/6UnNsnp.png)


# Copyright
Inspired by [Jeffrey Way's Flash Package](https://github.com/laracasts/flash).

## Installation

### Video Tutorial

[https://www.youtube.com/watch?v=sxLceVKcWoc](https://www.youtube.com/watch?v=sxLceVKcWoc)

### You like text ?

1. First, use [Composer](https://getcomposer.org/) to download the library:

- For Symfony 5.3+: `composer require mercuryseries/flashy-bundle`

- For Symfony versions lower than 5.3, please use: `composer require "mercuryseries/flashy-bundle:^3.0"`

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

- `$flashy->info('Welcome Aboard', 'http://your-awesome-link.com')`
- `$flashy->success('Welcome Aboard', 'http://your-awesome-link.com')`
- `$flashy->error('Uh Oh', 'http://your-awesome-link.com')`
- `$flashy->warning('Be careful!', 'http://your-awesome-link.com')`
- `$flashy->primary('Thanks for signing up!', 'http://your-awesome-link.com')`
- `$flashy->primaryDark('Thanks for signing up!', 'http://your-awesome-link.com')`
- `$flashy->muted('Can you see me?', 'http://your-awesome-link.com')`
- `$flashy->mutedDark('Can you see me?', 'http://your-awesome-link.com')`

This will set a few keys in the session:

- 'mercuryseries_flashy_notification.message' - The message you're flashing
- 'mercuryseries_flashy_notification.type' - A string that represents the type of notification (good for applying HTML class names)
- 'mercuryseries_flashy_notification.link' - The URL to redirect to on click

With this message flashed to the session, you may now display it in your view(s) by including the partial `@MercurySeriesFlashy/flashy.html.twig`: 

## Example

```twig
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Awesome Website</title>
    <!-- Load Flashy default CSS -->
    <link rel="stylesheet" href="{{ asset('bundles/mercuryseriesflashy/css/flashy.css') }}">
</head>
<body>
    <h1>Welcome to my website!</h1>
    
    <!-- Flashy depends on jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Load Flashy default JavaScript -->
    <script src="{{ asset('bundles/mercuryseriesflashy/js/flashy.js') }}"></script>
    <!-- Include Flashy default partial -->
    {{ include('@MercurySeriesFlashy/flashy.html.twig') }}
</body>
</html>
```

> Note that this bundle has jQuery as dependency. It's also better to load the flashy partial before your body close tag.

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
<link rel="stylesheet" href="{{ asset('bundles/mercuryseriesflashy/css/flashy.css') }}">

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
# config/packages/mercuryseries_flashy.yaml
mercuryseries_flashy:
    # The name to use as the flash message key in the session store
    flash_message_name:   mercuryseries_flashy_notification

    # The session store to use for storing flash messages
    session_store: null
```
