<template>
  <agile :options="settings" class="agile">
    <slot></slot>
    <template slot="prevButton"><i class="fas fa-chevron-left"></i></template>
    <template slot="nextButton"><i class="fas fa-chevron-right"></i></template>
  </agile>
</template>

<script>
import { VueAgile } from "vue-agile";
export default {
  components: {
    agile: VueAgile
  },
  data() {
    return {
      settings: {
        dots: false,
        navButtons: false,
        autoplay: true,
        responsive: [
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1
            }
          },
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 6,
              navButtons: true,
            }
          }
        ]
      }
    };
  }
};
</script>

<style lang="scss">
.agile {
  &__nav-button {
    background-color: rgba(0, 0, 0, 0);
    border: none;
    color: #024b74;
    font-size: 1.5rem;
  }
  &__nav-button--prev {
    transform: translateX(-5rem) translateY(-10rem);
  }
  &__nav-button--next {
    transform: translateX(5rem) translateY(-10rem);
  }
}
</style>
