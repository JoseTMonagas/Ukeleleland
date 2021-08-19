<template>
  <button type="submit" class="btn btn-primary" v-if="available">Agregar al Carrito</button>
  <button type="submit" class="btn btn-muted" disabled v-else-if="!available">Ya esta en el Carrito</button>
</template>
<script>
export default {
  props: ['productId'],
  data: function() {
    return {
      available: Boolean,
    };
  },
  methods: {
    checkIfProductInCart() {
      axios.get('/check-product/' + this.productId).then( response => {
        this.available = response.data.message;
      });
    },
    addProductoToCart() {
    
    }
  },
  created () {
    this.checkIfProductInCart();
  },
}
</script>
<style></style>
