export default {
    query: `mutation (
        $wishlistId: ID!
        $wishlistItems: [WishlistItemInput!]!
    ) {
        addProductsToWishlist (
            wishlistId: $wishlistId
            wishlistItems: $wishlistItems
        ) {
            wishlist {
                id
                items_count
                items_v2 {
                    items {
                        id
                        product {
                            sku
                        }
                    }
                }
            }
        }
    }`
}
