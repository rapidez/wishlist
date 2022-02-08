# Rapidez Wishlist

## Installation

```
composer require rapidez/wishlist
```

And register the Vue component in `resources/js/app.js`:
```
Vue.component('wishlist', require('Vendor/rapidez/wishlist/resources/js/Wishlist.vue').default)
```

If you haven't published the Rapidez views yet, publish them with:
```
php artisan vendor:publish --provider="Rapidez\Wishlist\WishlistServiceProvider" --tag=views
```

### Product page
Include the add-to-wishlist-button to the product page, for example in `resources/views/vendor/rapidez/listing/partials/item/addtocart.blade.php`:
```
@include('rapidez::wishlist.product.add-to-wishlist')
```

### Product listing
Include the add-to-wishlist-button to the listing items, for example in `resources/views/vendor/rapidez/listing/partials/item/addtocart.blade.php`:
```
@include('rapidez::wishlist.listing.add-to-wishlist')
```

### Wishlist items count
You can get the count of the customer's wishlist items by using the customer graphql query. For example:
```
<graphql v-if="$root.user" v-cloak query="{ customer { wishlists { id items_v2 { items { id product { sku } } } } } }">
    <span v-if="data" slot-scope="{ data }">
        @{{ data.customer.wishlists[0].items_v2.items.length }}
    </span>
</graphql>
```
