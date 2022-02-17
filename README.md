# Rapidez Wishlist

## Installation

```
composer require rapidez/wishlist
```

And require the Javascript in `resources/js/app.js`:
```
require('Vendor/rapidez/wishlist/resources/js/wishlist.js')
```

If you haven't published the Rapidez views yet, publish them with:
```
php artisan vendor:publish --provider="Rapidez\Wishlist\WishlistServiceProvider" --tag=views
```

### Product page

Include the wishlist button on the product page, for example in `resources/views/vendor/rapidez/product/partials/addtocart.blade.php`:
```
@include('rapidez::wishlist.product.wishlist')
```

### Product listing

Include the wishlist button on the listing items, for example in `resources/views/vendor/rapidez/listing/partials/item/addtocart.blade.php`:
```
@include('rapidez::wishlist.listing.wishlist')
```

### Account wishlist page

The wishlist account page can be found on `/account/wishlist` and [will be added to the menu automatically](https://github.com/rapidez/account/blob/master/resources/views/account/partials/menu.blade.php#L23:L29)

### Wishlist items count

You can get the count of the customer's wishlist items by using the wishlist component. For example:
```
<wishlist>
    <span slot-scope="{ itemsCount }">
        @{{ itemsCount }}
    </span>
</wishlist>
```
