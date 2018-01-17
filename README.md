# Gobble plugin for Craft 3

A simple plugin for sending REST API requests directly from your templates.

## Requirements

This plugin requires Craft 3.

## Installation

To install the plugin:

1. open your terminal and go to your Craft project:

   `cd /path/to/project`

2. tell Composer to load the plugin:

   ```
    composer require jfd/gobble
   ```

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Gobble.

## Using Gobble

A simple example:

```twig
{% set response = gobble({
    'url': 'https://example.com/api/endpoint',
    'method': 'GET'
}) %}

<ul>
    {% for item in response.body.data %}
        <li>{{ item.title }}</li>
    {% endfor %}
</ul>
```

### Required parameters

#### url

The complete URL to which the request should be sent, including the base URL and the endpoint.

#### method

The HTTP method to use for the request. Can be `GET`, `POST`, `PUT`, `PATCH` or `DELETE`.

### Optional parameters

#### auth

Use the `auth` parameter to pass an array of HTTP authentication parameters along with the request. The array must contain the username in index [0], the password in index [1], and you can optionally provide a built-in authentication type in index [2].

```twig
{% set response = gobble({
    'url': 'https://example.com/api/endpoint',
    'method': 'GET',
    'auth': [
        'username',
        'password',
        'digest' // optional
    ]
}) %}
```

#### body

Use the `body` parameter to pass body content along with an entity enclosing request (e.g. PUT, POST, PATCH).

```twig
{% set response = gobble({
    'url': 'https://example.com/api/endpoint',
    'method': 'POST',
    'body': 'Some body content...'
}) %}
```

#### headers

Use the `headers` parameter to pass an associative array of headers along with the request. Each key is the
name of a header, and each value is a string or array of strings representing the header field values.

```twig
{% set response = gobble({
    'url': 'https://example.com/api/endpoint',
    'method': 'GET',
    'headers': {
        'key': 'xxxxxxxxxxxxxxxxx',
        'secret': 'xxxxxxxxxxxxxxxxx'
    }
}) %}
```

#### query

Use the `query` parameter to pass an associative array of query string values or a query string along with the request.

**Note:** Query strings specified in the `query` parameter will overwrite all query string values supplied in the URL of a request.

Pass an array:

```twig
{% set response = gobble({
    'url': 'https://example.com/api/endpoint',
    'method': 'POST',
    'query': [
        'key1': 'value1',
        'key2': 'value2'
    ]
}) %}
```

Pass a string:

```twig
{% set response = gobble({
    'url': 'https://example.com/api/endpoint',
    'method': 'POST',
    'query': 'key1=value1&key2=value2'
}) %}
```
