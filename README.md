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

## Basic Examples

```php
[tgl_insert id="1q8o2t5pzHLUVH4VxWj1vmxlhpbeWTpHNUp1-UHwdDTQ" path="countryInformation.raw.contentHtml"]

// Output
From trekking in the beautiful mountains of the north to enjoying the glorious beaches in the south and  experiencing the hustle and bustle of the metropolis that is Bangkok, Thailand is certainly is not a country that lacks variety.
Whilst it really is at the heart of Southeast Asia, bordered by Myanmar, Laos, Cambodia and Malaysia, its cultural identity remains very unique. As the only country in Southeast Asia to avoid European powers, the Thai are proud to refer to themselves as ‘The Land of the Free’ and many tourists might also know it as ‘The Land of Smiles’ due to its friendly people.
Thailand has a constitutional monarchy currently headed by King Bhumibol Adulyadej, Rama IX and governed by a military junta (National Council for Peace and Order). The Thai monarchy - especially the King - remains an incredibly important part of Thai culture and is held in the highest respect. 

```

```php
[tgl_insert id="1q8o2t5pzHLUVH4VxWj1vmxlhpbeWTpHNUp1-UHwdDTQ" path="quickFacts" renderer="facts"]

// Output
Name:		Kingdom of Thailand
Population:	67 million
Capital:	Bangkok
Language:	Thai
Currency:	Baht (THB)
Time zone:	ICT (UTC +7)

```

```php
[tgl_insert id="1mKY3DddPftfvIDPK959drDwyOnTIuLiHUf3gWqdhZ9A" path="characteristics.physicalDemand.value"]

// Output
1

```

## Try Yourself
No better way to learn than to try yourself. This [Pen](http://codepen.io/thegreenlion/full/vyqeme/) lets you interactively try different documents and paths.