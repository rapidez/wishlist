<add-to-cart v-bind:product="item" v-cloak :callback="mutate">
    <div class="px-2 pb-2" slot-scope="{ options, error, add, disabledOptions, simpleProduct, getOptions, adding, added }">
        <div class="flex items-center space-x-2 mb-2">
            <div class="font-semibold">@{{ (simpleProduct.special_price || simpleProduct.price) | price }}</div>
            <div class="line-through text-sm" v-if="simpleProduct.special_price">@{{ simpleProduct.price | price }}</div>
        </div>

        <x-rapidez::button class="flex items-center" v-on:click="add" dusk="add-to-cart">
            <x-heroicon-o-shopping-cart class="h-5 w-5 mr-2" v-if="!adding && !added" />
            <x-heroicon-o-refresh class="h-5 w-5 mr-2 animate-spin" v-if="adding" />
            <x-heroicon-o-check class="h-5 w-5 mr-2" v-if="added" />
        </x-rapidez::button>
    </div>
</add-to-cart>
