export default {
    query: `mutation (
        $wishlistId: ID!
        $wishlistItemsIds: [ID!]!
    ) {
        removeProductsFromWishlist (
            wishlistId: $wishlistId
            wishlistItemsIds: $wishlistItemsIds
        ) {
            wishlist {
                id
                items_count
                items_v2 {
                    items {
                        id
                        product {
                            sku
                            id
                        }
                    }
                }
            }
        }
    }`
}
