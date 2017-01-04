TGL CONTENT INSERT
============

Wordpress plugin for easy integration TGL's descriptions into your website. Simple and fast via shortcodes.

You may also be interested in our [JS](https://github.com/the-green-lion/tgl-api-client-js), [PHP](https://github.com/the-green-lion/tgl-api-client-php) and [.Net](https://github.com/the-green-lion/tgl-api-client-csharp) client libraries.

##Dependencies
This library depends on the following projects:
- eelkevdbos/firebase-php [github](https://github.com/eelkevdbos/firebase-php/releases/tag/0.1.3)
- the-green-lion/tgl-api-client-js [github](https://github.com/the-green-lion/tgl-api-client-js)

##Installation

* Find the plugin in the [official plugin directory](https://wordpress.org/plugins/tgl-content-insert/)
* Install via the Wordpress plugins screen
* Go to 'Settings->TGL Contentent' and input your API key you received from TGL
* Ready to use our shortcodes!

## Basic Usage

Just drop the following shortcode into the text of your website:

```php
[tgl_insert id="..." path="..." renderer="..."]

```

## Parameters

### id
The ID of the document. This [Pen](http://codepen.io/thegreenlion/full/LbjdGj/) helps you find it.

### path
The node path within the JSON document to display. Node names are separated with a dot. See explanation below. This [Pen](http://codepen.io/thegreenlion/full/vyqeme/) helps you finding the right path.

### renderer
To help you get things to look good quickly, we added some rendering functions you can use:
- **facts**  Use this with any paragraph that has a child node called 'facts'

## Basic Examples
### Example 1: HTML paragraph
```javascript
[tgl_insert id="1q8o2t5pzHLUVH4VxWj1vmxlhpbeWTpHNUp1-UHwdDTQ" path="countryInformation.raw.contentHtml"]
```

**Output**
```
From trekking in the beautiful mountains of the north to enjoying the glorious beaches in the south and  experiencing the hustle and bustle of the metropolis that is Bangkok, Thailand is certainly is not a country that lacks variety.
Whilst it really is at the heart of Southeast Asia, bordered by Myanmar, Laos, Cambodia and Malaysia, its cultural identity remains very unique. As the only country in Southeast Asia to avoid European powers, the Thai are proud to refer to themselves as ‘The Land of the Free’ and many tourists might also know it as ‘The Land of Smiles’ due to its friendly people.
Thailand has a constitutional monarchy currently headed by King Bhumibol Adulyadej, Rama IX and governed by a military junta (National Council for Peace and Order). The Thai monarchy - especially the King - remains an incredibly important part of Thai culture and is held in the highest respect. 
```

### Example 2: Formatted Output

```javascript
[tgl_insert id="1q8o2t5pzHLUVH4VxWj1vmxlhpbeWTpHNUp1-UHwdDTQ" path="quickFacts" renderer="facts"]
```

**Output**
```
Name:		Kingdom of Thailand
Population:	67 million
Capital:	Bangkok
Language:	Thai
Currency:	Baht (THB)
Time zone:	ICT (UTC +7)
```

### Example 3: Number

```
Physical demand: [tgl_insert id="1mKY3DddPftfvIDPK959drDwyOnTIuLiHUf3gWqdhZ9A" path="characteristics.physicalDemand.value"] of 5
```

**Output**
```
Physical demand: 1 of 5
```

## Understand Our Documents

This [Pen](http://codepen.io/thegreenlion/full/vyqeme/) and this [Pen](http://codepen.io/thegreenlion/full/LbjdGj/) help you explore our documents while you read the following reference.

### Documents

Internally our information is structured in documents. Imagine them to be a folder full of MS Word files.
One document talks about one specific thing. E.g. about accommodation in Singburi. Information is not repeated in multiple documents. Each description of a program in Singburi actually only talks about the program. Not about the accommodation and not about how to get there, as we would have to repeat this information each time, allowing for copy past mistakes and issues once anything changes.

Each document, no matter what it is about, contains some general information:

| Path                   | Type     | What is this?                                                                            |
| ---------------------- | -------- | ---------------------------------------------------------------------------------------- |
| documentId             | Text     | The ID of the document. Each ID is unique and refers to one specific document.           |
| documentName           | Text     | The pretty name of what this document is about, e.g. 'Siam Culture' or 'Singburi'.       |
| documentSlug           | Text     | A URL friendly version of the name.                                                      |
| documentCss            | Text     | The styling of the document. You'll probably only need this in customly programed integrations |
| documentLastChanged    | Date     | The date and time when we changed the information last.                                  |
| documentLastPublished  | Date     | The date and time when we made the latest changes abvailable via our API. Usually a few hours or days after the latest change.               |

If you retrieve this info via our JSON API it will look like this:

```json
"documentCss" : ".dynLocation ul.lst-kix_mav6t69hg8lt-0{list-style-type:none}.dynLocation .lst-kix_mav6t69hg8lt-0>li:before{content:\"\\0025cf  \"}.dynLocation ol{margin:0;padding:0}.dynLocation table td,table th{padding:0}.dynLocation .c11{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-;border-top-width:1pt;border-right-width:1pt;border-left-;vertical-align:top;border-right-;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:121.9pt;border-top-;border-bottom-style:solid}.dynLocation .c7{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-;border-top-width:1pt;border-right-width:1pt;border-left-;vertical-align:top;border-right-;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:123pt;border-top-;border-bottom-style:solid}.dynLocation .c2{;font-weight:700;;vertical-align:baseline;;;}.dynLocation .c1{;;;vertical-align:baseline;;;}.dynLocation .c4{padding-top:0pt;padding-bottom:0pt;line-height:1.0;orphans:2;widows:2;text-align:justify}.dynLocation .c14{margin-left:-1.5pt;border-spacing:0;border-collapse:collapse;margin-right:auto}.dynLocation .c0{page-break-after:avoid;orphans:2;widows:2}.dynLocation .c5{orphans:2;widows:2}.dynLocation .c8{margin-left:36pt;padding-left:0pt}.dynLocation .c10{padding:0;margin:0}.dynLocation .c9{height:0pt}.dynLocation .c13{height:24pt}.dynLocation .c6{font-weight:700}.dynLocation .c3{}.dynLocation .c16{text-align:left}.dynLocation .c12{page-break-after:avoid}.dynLocation .c17{height:11pt}",
"documentId" : "1kV2z0GOj1_ZvWFDrqp3hMJ4Mh6J--QGtCJlEHYni1Ds",
"documentLastChanged" : "2016-12-10T15:20:44.413+01:00",
"documentLastPublished" : "2016-12-26T20:49:05.0319921+01:00",
"documentName" : "Singburi",
"documentSlug" : "singburi",
```

### Paraghraphs

Within a document, all information is structured in paragaphs. Just like in a actual MS Word document. For every paragraph, you can get its headline and its text. Some paragraphs additionally provide their content in a more structured form so you can pick and display a very specific piece of information.

| Path                        | Type         | What is this?                                                                          |
| --------------------------- | ------------ | -------------------------------------------------------------------------------------- |
| {paragraph}.raw.headline    | Text         | The original headline of this paragraph.                                               |
| {paragraph}.raw.contentHtml | Text         | The text of this paragraph as HTML code                                                |
| {paragraph}.raw.disclaimers | Array (Text) | Any information in this paragraph that we really wanted to peak out.                   |

{paragraph} stands for the actual name of the paragraph.

The JSON looks like:

```json
"description" : {
  "raw" : {
    "contentHtml" : "<p class=\"c5\"><span class=\"c3\">Your new home will be one of our 3 &lsquo;Eco Houses&rsquo; near Singburi, central Thailand: Lemon House, Twin House and Brown House. They are all located riverside (River Noi &ndash; Little River) in the village of Tha Kham and depending on which house you are staying at, is about 8-15km from Singburi (10-15 minutes by car). The 3 houses sleep from 30 to 72 people.</span></p><p class=\"c5\"><span class=\"c3\">All houses have a communal area where you can eat, relax, meet fellow participants or use the free Wifi.</span></p><p class=\"c5\"><span class=\"c3\">Although not directly on site, there are laundry facilities offered by locals which many of our participants take advantage of (this will probably cost you 5&#3647; per item, otherwise you can easily wash your clothes by hand.)</span></p>",
    "disclaimers" : [ "Important: A security cash deposit of 500TBH is required for the key to your room. It is payable upon arrival in cash and will be returned when they key is given back at the end of your stay.", "No alcohol is permitted in any of our accommodations, but we are located within walking distance of a local shop and there is even a makeshift bar provided by the friendly locals in front of the accommodation." ],
    "headline" : "About the Accommodation"
  }
},
```

### Facts

Some paragraphs in our documents list information like this:

**Minimum age:** -  
**Maximum age:** -  
**Minimum English level:** Basic  
**CRB required:** No  
**Passport copy required:**	No  
**Resume copy required:** No  
**Required qualification:**	None

We call this 'Facts'. To each line we refer as 'Fact'. In these cases we give you multiple ways (besides the raw HTML, as above) how to access the information, to suit your specific situation:

| Path                        | Type         | What is this?                                                                          |
| --------------------------- | ------------ | -------------------------------------------------------------------------------------- |
| {paragraph}.facts           | Array (Fact) |                                                                                        |
| {paragraph}.facts[i].title  | Text         | The title of the fact. That's what above you see before the colon.                     |
| {paragraph}.facts[i].value  | Text         | The value of the fact. That's what above you see behind the colon. If a fact is optional, it may have '-' instead of an actual value.                    |
| {paragraph}.{fact}.title    | Text         | The title of the fact. That's what above you see before the colon.                     |
| {paragraph}.{fact}.value    | Text         | The value of the fact. That's what above you see behind the colon.  If a fact is optional as has no value ('-'), it will not appear here.                    |

{paragraph} stands for the actual name of the paragraph, {fact} for the actual name of the fact.

The JSON looks like:

```json
"facts" : [ {
    "title" : "Minimum age",
    "value" : "-"
  }, {
    "title" : "Maximum age",
    "value" : "-"
  }, {
    "title" : "Minimum English level",
    "value" : "None"
  }, {
    "title" : "CRB required",
    "value" : "No"
  }, {
    "title" : "Passport copy required",
    "value" : "No"
  }, {
    "title" : "Resume copy required",
    "value" : "No"
  }, {
    "title" : "Required qualification",
    "value" : "None"
  } ],
  "raw" : {
    "contentHtml" : "<h2 class=\"c1\" id=\"h.i3pzvype50r4\"><span class=\"c2\">Standard Requirements</span></h2><p class=\"c3\"><span class=\"c5\">Minimum age:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class=\"c2\">-</span></p><p class=\"c3\"><span class=\"c5\">Maximum age:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class=\"c2\">-</span></p><p class=\"c3\"><span class=\"c5\">Minimum English level:</span><span class=\"c2\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;None </span></p><p class=\"c3\"><span class=\"c5\">CRB required:</span><span class=\"c2\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</span></p><p class=\"c3\"><span class=\"c5\">Passport copy required:</span><span class=\"c2\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</span></p><p class=\"c3\"><span class=\"c5\">Resume copy required:</span><span class=\"c2\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</span></p><p class=\"c3\"><span class=\"c5\">Required qualification:</span><span class=\"c2\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;None</span></p><h2 class=\"c1\" id=\"h.lh6l0defxouj\"><span class=\"c2\">Additional Requirements</span></h2><p class=\"c3\"><span class=\"c2\">There are no further requirements for this program.</span></p>",
    "headline" : "Participant Criteria & Requirements"
  },
  "requirementEnglishLevel" : {
    "title" : "Minimum English level",
    "value" : "None"
  },
  "requirementPassportCopy" : {
    "title" : "Passport copy required",
    "value" : "No"
  },
  "requirementPoliceCheck" : {
    "title" : "CRB required",
    "value" : "No"
  },
  "requirementQualification" : {
    "title" : "Required qualification",
    "value" : "None"
  },
  "requirementResume" : {
    "title" : "Resume copy required",
    "value" : "No"
  }
```

**Why so much redundancy?**
Besides the individual facts we are providing a array of facts for easily looping through these. The reason for always providing the titles - not just the values - is internationalization. Possibly we'll offer further languages in the future. So instead of hardcoding any text, you should rather use our given titles. If we were to add more languages, your solution would work in another language just as well.

## Media

### Document Media
Some of the documents come with media, such as programs, locations and countries. 

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| media.coverVideo            |                           | **Optional**                                                             |
| media.coverVideo.urlMp4     | Text                      | URL of the cover video in MP4 format.                                     |
| media.coverVideo.urlWebm    | Text                      | URL of the cover video in WEbM format.                                    |
| media.coverVideo.urlPoster  | Text                      | URL of the first frame of the video exported as Jpeg.                     |
| media.idMediaFolder         | Text                      | Google Drive ID of the media folder for this document.                    |
| media.idRawFootageFolder    | Text                      | Google Drive ID of the folder with raw footage folder for this document.  |
| media.lastChanged           | Date                      | Last time photos or videos were added, removed or edited.                 |
| media.urlBrowsePhotos       | Text                      | Link to the shared Google Drive folder containing media for this program. |
| media.urlBrowseRawFootage   | Text                      | Link to the shared Google Drive folder containing raw footage for this program.  |
| media.urlDownloadZipPhotosAll | Text                    | Download link for a zip file containing all photos of this program.       |
| media.urlDownloadZipPhotosTop | Text                    | Download link for a zip file containing our favorite photos of this program.    |

Each of these documents provides different images, that's why they are not listed here. See the specific document reference.

### Image

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| author                      | Text                      | Always says 'The Green Lion'                                              |
| description                 | Text                      | Description of the photo. Often empty. Suitable as subtitle in a gallery. |
| id                          | Text                      | Unique ID of the photo.                                                   |
| revision                    | Text                      | Uniqiue alphanumeric ID for the current revision. If the photo gets edited, the revision changes.         |
| sizes                       | Array ([Image Size](#image-size))     | See below.                                                    |

### Image Size

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| size                        | Text                      | Dimensions in pixel. Usually one of the following: '1920, 1440', '1024, 768', '480, 360', '80, 80'. We may add or remove sizes in the future. Best check dynamically for the size that gets closest to what you need. |
|url                          | Text                      | Url to the hosted photo.                                                  |

## How Information is Structured
### Program

This document describes a single program. It comes with the following information:

#### General

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| programId                   | Number                    | 2-4 digits number, unique to this program                                 |
| programIsTop                | Boolean                   | 'true' or false'. No important meaning. We e.g. show this more prominently in our catalog. |
| programState                | Enum (Text)               | 'Enabled' or 'Disabled'. Depends on if we still offer this program or not. |
| programType                 | Enum (Text)               | 'Basic', 'Exclusive', 'Group' or 'Offer'                                  |
| urlFacebook                 | Text                      | **OPTIONAL** If this program has a Facebook page, this is the link.       |
| locations                   | Array                     | References to all locations that this program passes by at                |
| locations[i].id             | Text                      | ID of the corresponding location document.                                |
| locations[i].name           | Text                      | Name of the corresponding location.                                       |
| country                     |                           | Reference to the country of this program.                                 |
| country.id                  | Text                      | ID of the corresponding country document.                                 |
| country.name                | Text                      | Name of the corresponding country.                                        |

#### Paragraphs

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| overview                    | [Paragraph](#paraghraphs) | The 'Quick Overview' paragraph.                                           |
| overview.shortenedIntro     | Text                      | Short version of the 'Quick Overview' paragraph. Max 160 characters.      |
| &nbsp;                      |                           |                                                                           |
| price                       |                           | The 'Pricing' paragraph.                                                  |
| price.currentPrice          | Number                    | The program price at the time of 'documentLastPublished'                  |
| price.prices                | Key/Value                 | Key: The date from which on a price applies. Value: Price                 |
| &nbsp;                      |                           |                                                                           |
| characteristics             | [Paragraph](#paraghraphs) | The 'Program Characteristics' paragraph. Contains [Facts](#facts).        |
| characteristics.communityService | Number               | 1 (little) to 5 (high)                                                    |
| characteristics.culture     | Number                    | 1 (little) to 5 (high)                                                    |
| characteristics.learning    | Number                    | 1 (little) to 5 (high)                                                    |
| characteristics.leisure     | Number                    | 1 (little) to 5 (high)                                                    |
| characteristics.physicalDemand | Number                 | 1 (little) to 5 (high)                                                    |
| &nbsp;                      |                           |                                                                           |
| availability                | [Paragraph](#paraghraphs) | The 'Program Duration & Availability' paragraph. Contains [Facts](#facts). |
| availability.availableFrom  | Date                      | Date first participants can arrive                                        |
| availability.availableUntil | Date                      | **Optional** Date last participants can arrive. Then program discontinues. |
| availability.bookableUntil  | Date                      | **Optional** Date last booking can be made, even for a later date. Latest 'availableUntil'.  |
| availability.minDuration    | Number                    | Minimum program duration (weeks)                                          |
| availability.maxDuration    | Number                    | **Optional** Maximum program duration (weeks)                             |
| &nbsp;                      |                           |                                                                           |
| description                 | [Paragraph](#paraghraphs) | The 'Program Description' paragraph.                                      |
| &nbsp;                      |                           |                                                                           |
| aims                        | [Paragraph](#paraghraphs) | The 'Aims & Objectives' paragraph.                                        |
| &nbsp;                      |                           |                                                                           |
| schedule                    | [Paragraph](#paraghraphs) | The 'Schedule' paragraph.                                                 |
| schedule.weeks              | Array ([Schedule Week](#schedule-week)) | See below.                                                  |
| &nbsp;                      |                           |                                                                           |
| startingDates               | [Paragraph](#paraghraphs) | The 'Starting Dates' paragraph.                                           |
| startingDates.startingDates | Array ([Starting Dates](#starting-dates)    | See below.                                              |
| &nbsp;                      |                           |                                                                           |
| requirements                | [Paragraph](#paraghraphs) | The 'Participant Criteria & Requirements' paragraph.  Contains [Facts](#facts). |
| requirements.requirementEnglishLevel.title    | Text    | Original English name of this requirement                                 |
| requirements.requirementEnglishLevel.value    | Enum    | One of the following values:  'None', 'Basic', 'Intermediate", 'Advanced' |
| requirements.requirementMinimumAge.title      | Text    | Original English name of this requirement                                 |
| requirements.requirementMinimumAge.value      | Number  | **Optional** Minimum participant age. No age means our standard terms apply.     |
| requirements.requirementMaximumAge.title      | Text    | Original English name of this requirement                                 |
| requirements.requirementMaximumAge.value      | Number  | **Optional** Maximum participant age. No age means our standard terms apply.     |
| requirements.requirementPassportCopy.title    | Text    | Original English name of this requirement                                 |
| requirements.requirementPassportCopy.value    | Enum    | One of the following values: 'No', 'On Signup', 'On Arrival'              |
| requirements.requirementPoliceCheck.title     | Text    | Original English name of this requirement                                 |
| requirements.requirementPoliceCheck.value     | Enum    | One of the following values: 'No', 'On Signup', 'On Arrival'              |
| requirements.requirementQualification.title   | Text    | Original English name of this requirement                                 |
| requirements.requirementQualification.value   | Text    | Very short description of any neded qualification or 'None'               |
| requirements.requirementResume.title          | Text    | Original English name of this requirement                                 |
| requirements.requirementResume.value          | Enum    | One of the following values: 'No', 'On Signup', 'On Arrival'              |
| requirements.additionalRequirements | [Paragraph](#paraghraphs) | Free text about any further requirements. May also say that there are no further requirements.      |
| &nbsp;                      |                           |                                                                           |
| equipment                   | [Paragraph](#paraghraphs) | The 'Additional Equipment' paragraph.                                     |

##### Schedule Week

A schedule week either starts on a Sunday or a Monday and can not have more than 7 days. A schedule week can summarize multiple actual weeks if they have the same itinerary.

| Path                        | Type              | What is this?                                                                     |
| --------------------------- | ----------------- | --------------------------------------------------------------------------------- |
| days                        | Array ([Schedule Item](#schedule-item))   | See below.                                                |
| duration                    | Number            | Usually 1. A greater number would mean that this sequence of days repeats for the specified number of weeks |
| extendable                  | Boolean           | Usually 'false'. Only relevant for multi week schedules. 'true' means that if someone booked this program for more weeks than specified in the schedule, this week would be repeated.  |
| headline                    | Text              | 'Schedule' if the whole schedule has only one week. Otherwise the title of this week.  |

##### Schedule Item

A schedule item refers to one or multiple days within a week.

| Path                        | Type              | What is this?                                                                     |
| --------------------------- | ----------------- | --------------------------------------------------------------------------------- |
| contentHtml                 | Text              | The text of this paragraph as HTML code                                           |
| daysOfWeek                  | Array (Text)      | The names of the days that this schedule item applies to.                         |
| headline                    | Text              | The original headline of this paragraph. Usually a specific day or a range of days like 'Monday to Wednesday'. Could also be 'Weekend' or 'A typical day looks like' which means Monday to Friday.  |
| headlineAlternative         | Text              | Similar to 'headline', just that if 'headline is 'A typical day looks like', this will be 'Monday to Friday' and instead of 'Weekend' it's 'Saturday to Sunday' |


##### Starting Dates

| Path                        | Type              | What is this?                                                                     |
| --------------------------- | ----------------- | --------------------------------------------------------------------------------- |
| startsEveryWeek             | Boolean           | 'true' if the program starts every week. Then 'dates' doesn't exist'.             |
| year                        | Number            | The year that these dates refer to.                                               |
| dates                       | Array (Date)      | **Optional** Actual starting dates. Only exists if 'startsEveryWeek' is 'false'.  |

#### Media

| Path                        | Type                               | What is this?                                                    |
| --------------------------- | ---------------------------------- | ---------------------------------------------------------------- |
| media                       | [Document Media](#document-media)  |                                                                  |
| media.images                | Array ([Image](#image))            | Photos about the program.                                        |


### Location

This document describes a location. This means our accommodation there as well as the surroundings. There can be one or multiple programs at one location. One program can stop at multiple locations one after another.

Important for us is always where participants sleep. There may be two programs in the surroundings of the same city and participants stay in different places. Then we differentiate as two different locations. On the other hand participants may be joining programs in different villages/cities but stay in the same place. Then we refer to it as one location.

#### General

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| country                     |                           | Reference to the country this location is in.                             |
| country.id                  | Text                      | ID of the corresponding country document.                                 |
| country.name                | Text                      | Name of the corresponding country.                                        |

#### Paragraphs

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| location                    | [Paragraph](#paraghraphs) | The 'Location' paragraph.                                                 |
| &nbsp;                      |                           |                                                                           |
| geolocation                 | [Paragraph](#paraghraphs) | The 'Geolocation' paragraph.                                              |
| geolocation.coordinates     | Array                     | Listing of GPS coordinates of this location. Usually its just one coordinate.     |
| geolocation.coordinates[i].latitude | Number            |                                                                           |
| geolocation.coordinates[i].longitud | Number            |                                                                           |
| &nbsp;                      |                           |                                                                           |
| accommodation               |                           | The 'Accommodation & Food' paragraph.                                     |
| accommodation.headline      | Text                      | 'Accommodation & Food'                                                    |
| accommodation.description   | [Paragraph](#paraghraphs) | General description of the accommodation.                                 |
| accommodation.food          | [Paragraph](#paraghraphs) | Description of the food served at the accommodation.                      |
| accommodation.overview      | [Paragraph](#paraghraphs) | Comparison of different available room types in HTML table form.          |
| accommodation.types         | Array ([Accommodation Type](#accommodation-type)  | Comparison of different available room types in HTML table form.          |
| &nbsp;                      |                           |                                                                           |
| facilities                  | [Paragraph](#paraghraphs) | The 'Facilities' paragraph.                                               |
| &nbsp;                      |                           |                                                                           |
| activities                  | [Paragraph](#paraghraphs) | The 'Activities & Events' paragraph.                                      |
| activities.activities       | Array ([Paragraph](#paraghraphs)) | **Optional** Each paragraph is one activity. The headline usually says when it is conducted. Doesn't exist if there are no extra activities.       |
| &nbsp;                      |                           |                                                                           |
| surroundings                | [Paragraph](#paraghraphs) | The 'Sights & Surroundings' paragraph.                                    |
| &nbsp;                      |                           |                                                                           |
| transportation              | [Paragraph](#paraghraphs) | The 'Transportation' paragraph.                                           |
| transportation.freeTransportTo         | Array          | Listing of all location to which we transfer participants for free for their next program after finishing their program at the current location.                 |
| transportation.freeTransportTo[i].id   | Text           | ID of the corresponding location document.                                |
| transportation.freeTransportTo[i].name | Text           | Name of the corresponding location.                                       |

##### Accommodation Type

An accommodation type is also a [Paragraph](#paraghraphs) and holds its properties as [Facts](#facts).

| Path                        | Type                               | What is this?                                                    |
| --------------------------- | ---------------------------------- | ---------------------------------------------------------------- |
| upgradePrice                |                           | The additional price to be paid on top of the program price for staying in this room type      |
| upgradePrice.currentPrice   | Number                    | The upgrade price at the time of 'documentLastPublished'                  |
| upgradePrice.prices         | Key/Value                 | Key: The date from which on a price applies. Value: Price                 |
| media                       |                           |                                                                           |
| media.idMediaFolder         | Text                      | Google Drive ID of the media folder for this document.                    |
| media.images                | Array ([Image](#image))   | Photos of this room type.                                                 |


#### Media

| Path                        | Type                               | What is this?                                                    |
| --------------------------- | ---------------------------------- | ---------------------------------------------------------------- |
| media                       | [Document Media](#document-media)  |                                                                  |
| media.imagesActivities      | Array ([Image](#image))            | **Optional** Photos of additional activities offered for all participants at this location.       |
| media.imagesScenic          | Array ([Image](#image))            | **Optional** Photos of the surroundings and setting of this location.             |

### Arrival Information

This document describes a point of arrival. This is usually an airport and optionally some meeting point close to it, for overland arrivals. From there we may transfer participants to different locations for their program. For each location there is only (and exactly) one corresponding arrival information document.

*Not available via our API yet. Coming Soon...*

### Departure Information

This document describes how to get back to a point of arrival. apply to one or multiple locations, same as the arrival information. For each location there is only (and exactly) one corresponding departure information document.

*Not available via our API yet. Coming Soon...*

### Holidays

This document describes the public holidays and school holidays for one, multiple or all location in a country. For each location there is only (and exactly) one corresponding holiday document.

*Not available via our API yet. Coming Soon...*

### Country

#### General

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| isoCode                     | Text                      | 2 digit country code (ISO 3166)                                           |
| urlFacebook                 | Text                      | **OPTIONAL** If this country has a Facebook page, this is the link.       |

#### Paragraphs

| Path                        | Type                      | What is this?                                                             |
| --------------------------- | ------------------------- | ------------------------------------------------------------------------- |
| quickFacts                  | [Paragraph](#paraghraphs) | The 'Quick Overview' paragraph.                                           |
| quickFacts.name.title       | Text                      | Original English name of this fact.                                       |
| quickFacts.name.value       | Text                      | Full name of this country.                                                |
| quickFacts.population.title | Text                      | Original English name of this fact.                                       |
| quickFacts.population.value | Text                      | Population, usually in million.                                           |
| quickFacts.capital.title    | Text                      | Original English name of this fact.                                       |
| quickFacts.capital.value    | Text                      | Capital of the country.                                                   |
| quickFacts.language.title   | Text                      | Original English name of this fact.                                       |
| quickFacts.language.value   | Text                      | Official language(s).                                                     |
| quickFacts.currency.title   | Text                      | Original English name of this fact.                                       |
| quickFacts.currency.value   | Text                      | LOcal currency. Usually full name and abbreviation.                       |
| quickFacts.timeZone.title   | Text                      | Original English name of this fact.                                       |
| quickFacts.timeZone.value   | Text                      | Time zone. Usually its name and its difference to UTC time.               |
| &nbsp;                      |                           |                                                                           |
| countryInformation          | [Paragraph](#paraghraphs) | The 'Country Information' paragraph.                                      |
| climate                     | [Paragraph](#paraghraphs) | The 'Climate' paragraph.                                                  |
| culture                     | [Paragraph](#paraghraphs) | The 'Culture' paragraph.                                                  |
| transportation              | [Paragraph](#paraghraphs) | The 'Transportation' paragraph.                                           |

#### Media

| Path                        | Type                               | What is this?                                                    |
| --------------------------- | ---------------------------------- | ---------------------------------------------------------------- |
| media                       | [Document Media](#document-media)  |                                                                  |
| media.imagesScenic          | Array ([Image](#image))            | Photos about the country.                                        |
| media.imagesPeople          | Array ([Image](#image))            | **Optional** Photos of unique people and characters.             |
| media.imagesFood            | Array ([Image](#image))            | **Optional** Photos of cool food arrangements or culinary highlights.      |

### Contacts & Addresses

For each country there is one document listing relevant contact persons for program inquiries, transfer, emergencies etc.

| Path                        | Type              | What is this?                                                                     |
| --------------------------- | ----------------- | --------------------------------------------------------------------------------- |
| addresses                   | Array ([Paragraph](#paraghraphs))  | Address paragraphs. Each paragraph is one address.               |
| furtherContacts             | Array ([Contact](#contact))        | **Optional** Further contact persons in the country. This may involve transfer coordinators or program coordinators. See below.     |
| mainContacts                | Array([Contact](#contact))         | Your first point of contact. See below.                          |
| marketingContacts           | Array([Contact](#contact))         | Your contact before starting to market a country. See below   .  |

#### Contact

A contact is also a [Paragraph](#paraghraphs) and holds its properties as [Facts](#facts).

| Path                        | Type              | What is this?                                                                     |
| --------------------------- | ----------------- | --------------------------------------------------------------------------------- |
| contactReasons              | Array (Text)      | **Optional** Listing of reasons why to contact this person. Usually some of the following: 'Programs/Logistics Inquiries', 'Emergencies', 'Transfer Issues'             |
| email                       | Text              | **Optional** Email of the contact person                                          |
| fax                         | Text              | **Optional** Fax number of the contact person                                     |
| firstName                   | Text              | First name of the contact person. 'Office' for local offices.                     |
| gender                      | Enum              | One of the following values: 'Male', 'Female'                                     |
| languages                   | Array (Text)      | Listing of languages a contact person speaks.                                     |
| lastName                    | Text              | **Optional** Last name of the contact person.                                     |
| mobilePhones                | Array (Text)      | **Optional** Listing of mobile phone numbers of a contact person                  |
| phone                       | Text              | **Optional** Landline phone number of the contact person                          |
| skype                       | Text              | **Optional** Skype name of a contact person                                       |

### Starting Dates
In some countries arrival is limited to certain dates, e.g. the first and third week of a month. For each different arrival date situation, there is one document that may apply to one or multiple countries. All locations in one country follow the same dates, so for one country there is only one corresponding starting dates document.

Keep in mind that these dates only refer to arrivals to the country. Certain programs in the country may have limited starting dates on their own.

| Path                        | Type                                      | What is this?                                             |
| --------------------------- | ----------------------------------------- | --------------------------------------------------------- |
| howItWorks                  | [Paragraph](#paraghraphs)                 | Short text about what the following dates mean            |
| startingDates               | [Paragraph](#paraghraphs)                 |                                                           |
| startingDates.startingDates | Array ([Starting Dates](#starting-dates)  | Starting dates for the current (and optionally next) year |
