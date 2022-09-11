<template>
        <span>
            <label>Quantity: </label>
            <input type="text" value="3" />
            <button @click.prevent="addProductToCart" type="button" class="btn btn-default cart">
                <i class="fa fa-shopping-cart"></i>
                Add to cart
            </button>
        </span>
</template>

<script>
    export default {
        props: [
            'userId' 
        ],
        data() {
            return {
                product : {}
            }
        },
        methods: {
            async addProductToCart(){
                if(this.userId == 0){
                    this.$toastr.e('You need to login, to add this product in Cart');
                    return ;
                }
                let response = await axios.post('/cart', {
                    'product_id' : this.product.id
                });
                this.$root.$emit('changeInCart', response.data.items);
                this.$toastr.s(response.data.message)
            },

            async getProduct () {
                const response = await axios.post('/getProduct', {
                    "path" : window.location.pathname
                })
                this.product = response.data
            }            
        },
        mounted() {
            this.getProduct()
        }
    }
</script>
