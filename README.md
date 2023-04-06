# Rapidez Wishlist

## Installation

```bash
composer require rapidez/wishlist
```

If you haven't published the Rapidez views yet, publish them with:
```bash
php artisan vendor:publish --provider="Rapidez\Wishlist\WishlistServiceProvider" --tag=views
```

### Product page

Include the wishlist button on the product page, for example in `resources/views/vendor/rapidez/product/partials/addtocart.blade.php`:
```blade
@include('rapidez::wishlist.product.wishlist')
```

### Product listing

Include the wishlist button on the listing items, for example in `resources/views/vendor/rapidez/listing/partials/item/addtocart.blade.php`:
```blade
@include('rapidez::wishlist.listing.wishlist')
```

### Account wishlist page

The wishlist account page can be found on `/account/wishlist` and [will be added to the menu automatically](https://github.com/rapidez/account/blob/master/resources/views/account/partials/menu.blade.php#L23:L29)

### Wishlist items count

You can get the count of the customer's wishlist items by using the wishlist component. For example:
```blade
<wishlist v-cloak>
    <span slot-scope="{ itemsCount }">
        @{{ itemsCount }}
    </span>
</wishlist>
```
