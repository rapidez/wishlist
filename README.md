# Rapidez Wishlist

## Installation

```bash
composer require rapidez/wishlist
```

After that you'll get: 
- Wishlist button on a product item in listings
- Button on product pages on top of the image
- Wishlist account page

You can see here how that's implemented in various packages:
- [rapidez/core](https://github.com/search?q=repo%3Arapidez%2Fcore%20WishlistServiceProvider&type=code)
- [rapidez/account](https://github.com/search?q=repo%3Arapidez%2Faccount%20WishlistServiceProvider&type=code)

Optionally you could publish and change the views with
```bash
php artisan vendor:publish --provider="Rapidez\Wishlist\WishlistServiceProvider" --tag=views
```

### Showing the button somewhere else

Just include the button where you'd like it:

```blade
@include('rapidez::wishlist.button')
```

And make sure the required information is available, see the [button view](https://github.com/rapidez/wishlist/blob/master/resources/views/wishlist/button.blade.php).

### Wishlist items count

You can get the count of the customer's wishlist items by using the wishlist component. This could be used somewhere in the header, example:

```blade
<wishlist v-cloak>
    <span slot-scope="{ itemsCount }">
        @{{ itemsCount }}
    </span>
</wishlist>
```
