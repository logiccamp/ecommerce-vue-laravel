<template>
    <a href="/cart"><i class="fa fa-shopping-cart"></i> Cart <small>{{count}}</small> </a>
</template>


<script>
export default {
    data() {
        return {
            count : 0,
        }
    },

    methods: {
        async getCartTotal(){
            const response = await axios.post("/cart")
            this.count = response.data.items
        }
    },

    mounted() {
        this.getCartTotal();
        this.$root.$on('changeInCart', (item) => {
            this.count = item;
        })
    },
}
</script>