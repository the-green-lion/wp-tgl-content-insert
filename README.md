TGL CONTENT INSERT
============

Wordpress plugin for easy integration TGL's descriptions into your website. Simple and fast via shortcodes.

##Dependencies
This library depends on the following projects:
- eelkevdbos/firebase-php [github](https://github.com/eelkevdbos/firebase-php/releases/tag/0.1.3)
- the-green-lion/tgl-api-client-js [github](https://github.com/the-green-lion/tgl-api-client-js)

## Basic Usage

```php
[tgl_insert id="..." path="..." renderer="..."]

```

## Parameters

### id
The ID of the document. This [Pen](http://codepen.io/thegreenlion/full/LbjdGj/) helps you find it.

### path
The node path within the JSON document to display. Node names are separated with a dot. See explanation below.

### renderer
To help you get things to look good quickly, we added some rendering functions you can use on objects within the JSON document.
- **facts** Use this with any paragraph that has a child node called 'facts'
