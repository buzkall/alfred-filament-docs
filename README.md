# Filament Docs Workflow for Alfred v4

An ultra-fast Filament docs search workflow for Alfred 4 and Filament 5

Adapted from [Filament Docs Workflow for Alfred](https://github.com/intrepidws/alfred-filament-docs), which is adapted from [Alfred TailwindCSS Docs](https://github.com/clnt/alfred-tailwindcss-docs), which is adopted from [Alfred VueJS Docs](https://github.com/vmitchell85/alfred-vuejs-docs), which is adapted from [Alfred Laravel Docs](https://github.com/tillkruss/alfred-laravel-docs), Thanks [Till Krüss](https://twitter.com/tillkruss)!

![Screenshot](screenshot.jpg)

## Installation


1. [Download the latest version](https://github.com/buzkall/alfred-filament-docs/releases/download/v3.1.0/Filament.Docs.alfredworkflow)
2. Install the workflow by double-clicking the `.alfredworkflow` file
3. You can add the workflow to a category, then click "Import" to finish importing. You'll now see the workflow listed in the left sidebar of your Workflows preferences pane.

## Usage

To search the [5.x docs](https://filamentphp.com/docs/5.x/panels/installation), just type `fm` followed by your search query.

```
fm <query>
```

To search the [4.x docs](https://filamentphp.com/docs/4.x/panels/installation), just type `fm4` followed by your search query.

```
fm4 <query>
```

To search the [3.x docs](https://filamentphp.com/docs/3.x/panels/installation), just type `fm3` followed by your search query.

```
fm3 <query>
```

To search the [2.x docs](https://filamentphp.com/docs/2.x/admin/installation), just type `fm2` followed by your search query.

```
fm2 <query>
```

To search the [1.x docs](https://filamentphp.com/docs/1.x/admin/getting-started), just type `fm1` followed by your search query.

```
fm1 <query>
```

Either press `⌘Y` to Quick Look the result, or press `<enter>` to open it in your web browser.

![Search by Algolia](algolia.png)

## Building the .alfredworkflow file

To rebuild the distributable `.alfredworkflow` file, run:

```
zip -r Filament.Docs.alfredworkflow . -x '.git/*' '.gitignore' '.idea/*' '.DS_Store' '*.alfredworkflow' 'screenshot.jpg'
```
