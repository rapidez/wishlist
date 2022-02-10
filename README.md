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
Include the add-to-wishlist-button to the product page, for example in `resources/views/vendor/rapidez/product/partials/addtocart.blade.php`:
```
@include('rapidez::wishlist.product.add-to-wishlist')
```

### Product listing
Include the add-to-wishlist-button to the listing items, for example in `resources/views/vendor/rapidez/listing/partials/item/addtocart.blade.php`:
```
@include('rapidez::wishlist.listing.add-to-wishlist')
```

### Wishlist items count
You can get the count of the customer's wishlist items by using the wishlist component. For example:
```
<wishlist>
    <span slot-scope="{ itemsCount }">
        @{{ itemsCount }}
    </span>
</wishlist>
```
