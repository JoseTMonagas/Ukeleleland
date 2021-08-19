<template>
  <a href="#" :style="base">          
    <div>
      <h4 class="text-light m-2 mb-4">
        <span class="p-2 bg-primary text-light">COMPRAR</span>
        UKELELES
        <i class="text-shadow text-primary fa fa-chevron-right" aria-hidden="true"></i>
      </h4>
    </div>
  </a>
</template>
<script>
export default{
  props: [
    'hText',
    'lText',
    'img'
  ],
  computed: {
    base: function() {
      return 'background-image: url(' + img + '); background-size: cover; min-height:300px'
    }
  }
}
</script>
<style></style>
