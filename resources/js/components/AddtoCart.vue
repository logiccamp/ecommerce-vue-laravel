<template>
    <div>
        <a href="#" v-on:click.prevent="addProductToCart" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                
            }
        },
        props: [
            'productId', 'userId' 
        ],
        methods: {
            async addProductToCart(){
                if(this.userId == 0){
                    this.$toastr.e('You need to login, to add this product in Cart');
                    return ;
                }

                let response = await axios.post('/cart', {
                    'product_id' : this.productId
                });
                
                this.$root.$emit('changeInCart', response.data.items);
                this.$toastr.s(response.data.message)
            }            
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
