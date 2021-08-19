<template>
</template>

<script>
export default {
  props: {
    product: Object,
    img: String
  },
  mounted: function() {
    console.log("Component Mounted");
    console.log(product);
  },

};
</script>

<style lang="scss" scoped>
  div {
  }
</style>
