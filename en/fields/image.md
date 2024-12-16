# Image

Inherits [File](/docs/{{version}}/fields/file).

* has the same capabilities

The *Image* field is an extension of *File* that allows previewing uploaded images.

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Image;

Image::make('Thumbnail')
```
tab: Blade
```blade
<x-moonshine::form.file
    :imageable="true"
    name="thumbnail"
/>
```
~~~

![image](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/image.png)

![image dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/image_dark.png)