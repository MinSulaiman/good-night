<div align="center">
    بسم الله الرحمن الرحيم
</div>

# Good Night

Switch the dark-mode of your TALL Stack application with ease.

### Description

The concept of [dark-mode in TailwindCSS](https://tailwindcss.com/docs/dark-mode) with `class` strategy is simply about adding `dark` class to the `html` element in the page, which activates the Tailwind classes that are prefixed with the `dark:` [psuedo-element](https://tailwindcss.com/docs/hover-focus-and-other-states#pseudo-elements)...

Therefore, we can utilize an Alpine.js custom [bind](https://alpinejs.dev/globals/alpine-bind) to **either** add a dark-mode switcher in a **configurable** corner of the page, **or** apply a different bind to a clickable element which will hook the necessary logic to it on its own.

![2022-07-14-06-39-48](https://user-images.githubusercontent.com/81492351/178893504-37173339-5709-48f8-9359-a67e63d08942.gif)


## Installation

This is a [TALL Stack](https://tallstack.dev) supportive package, so... -you know the drill! 🙂

### Requirements

- [TailwindCSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Laravel](https://laravel.com)

### Steps

1. Install the package via Composer:

   ```bash
   composer require goodm4ven/good-night
   ```

2. Publish the package configuration and view files:

   ```bash
   php artisan vendor:publish --provider="GoodM4ven\GoodNight\GoodNightServiceProvider"
   ```

   - If your'e **updating** the package, please use `--force` option along the above command to **override** the old assets.

3. Open the published `config/good-night.php` file, and determine the **default mode** as well as whether the corner switcher is on or not.

   - <details>
       <summary>
         Here are the <b>default</b> configurations of the file.
       </summary><br>

     ```php
     /*
      |--------------------------------------------------------------------------
      | Default Mode
      |--------------------------------------------------------------------------
      |
      | Determine the default dark/light mode that the app will start with.
      |
      | The default is `light` and is stored in `$store.goodNightMode`.
      |
      */

     'default-mode' => env('GOOD_NIGHT_DEFAULT', 'light'),


     /*
      |--------------------------------------------------------------------------
      | Switcher Enabled
      |--------------------------------------------------------------------------
      |
      | Decide whether to show or hide the corner dark-mode switcher in the page.
      |
      | Either way, the package won't work without `@goodNight` directive.
      |
      */

     'switcher-enabled' => env('GOOD_NIGHT_ENABLED', true),


     /*
      |--------------------------------------------------------------------------
      | Switcher Position
      |--------------------------------------------------------------------------
      |
      | Determine the position of the corner switcher button when shown in the page.
      |
      | Available positions are: top-right, top-left, bottom-left, bottom-right.
      |
      */

     'switcher-position' => env('GOOD_NIGHT_POSITION', 'top-right'),
     ```
     </details>

4. Add the following Blade directive to your `master` layout or view:

   ```html
   <body>
       @goodNight
       ...
   </body>
   ```

5. Modify the `darkMode` and the `content` of your `tailwind.config.js` file:

   ```js
   module.exports = {
       content: [
           ...
           './resources/views/**/*.blade.php', // or to './resources/views/vendor/good-night/**' specifically...
       ],

       darkMode: 'class',
       ...
   }
   ```

6. Compile your views with dark Tailwind classes into `app.css`, and Alpine in your `app.js`.


## Usage

There are 2 different ways to use this package:

1. Enable the corner switcher in configuration and it will be displayed by default.

   - You can customize the published view at `resources/views/vendor/good-night/partials/good-night-switcher.blade.php`.

2. Disable the corner switcher in configuration and then add the following to a clickable element:

   ```html
   <button
       x-data="goodNight()"
       x-bind="custom"
   >
       Theme Changer
   </button>
   ```

And yes, in both cases, the package **will not work** without having `@goodNight` Blade directive in the page!

### Cases

- How does this switching happen smoothly?

  - By adding one of the [`transition` Tailwind property](https://tailwindcss.com/docs/transition-property) classes on the thingies with `dark:` pseudo-elements.

- What if I want to add extra logic upon theme switching?

  - You can pass a callback to `goodNight()`, like so:

    ```html
    <button
        x-data="goodNight(() => { console.log('it\'s still 8, Mom!') })"
        x-bind="custom"
    >
        😠
    </button>
    ```


## Development

**P**ull-**r**equests are free around here. A special package privilage, you know. 😋

- There's an available and automated [CHANGELOG](CHANGELOG.md) of all the updates.

### TODOs

- Abstract the binding in a custom Alpine.js [directive](https://alpinejs.dev/advanced/extending#custom-directives), somehow; maybe. 🤔

  ```html
  <button
      x-data {{-- Or on a parent somewhere, so it's optional --}}
      x-good-night="optionalCallback()" {{-- It does writes "good-night" only once! --}}
  >
      Switcher
  </button>
  ```

- Write [Pest](https://pestphp.com) and [Cypress](https://cypress.io) tests! 🥲


## Remarks

Please do 🌟 all the packages you rely on, but NOT this one. 😍


<div align="center">
   <br>والحمد لله رب العالمين
</div>
