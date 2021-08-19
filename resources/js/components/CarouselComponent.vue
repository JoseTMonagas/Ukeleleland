<template>
  <!-- Container for the image gallery -->
  <div class="container">

    <!-- Full-width images with number text -->
    <div class="container-fluid">
      <img :src="currentImg" class="img-fluid">
    </div>

    <!-- Next and previous buttons -->
    <a class="prev btn btn-primary" @click="showSlides(--slideIndex)"><i class="text-white fas fa-caret-left"></i></a>
    <a class="next btn btn-primary" @click="showSlides(++slideIndex)"><i class="text-white fas fa-caret-right"></i></a>

    <!-- Thumbnail images -->
    <div class="row">
      <div v-for="(img, index) in images" :key="index" class="col">
        <img class="demo cursor" :src="img" style="width:100%" @click="showSlides(index)" alt="...">
      </div>
    </div>
  </div> 
</template>
<script>
export default {

  data: function() {
    return {
      slideIndex: 0,
      currentImg: String
    }
  },
  props: ['images'],
  methods: {
    showSlides: function (n) {
      this.slideIndex = n
      if (this.slideIndex > this.images.length) {
        this.slideIndex = 0
      } else if (this.slideIndex < 0) {
        this.slideIndex = this.images.length
      }
      this.currentImg = (this.images[this.slideIndex])
    }
  },
  mounted() {
    this.showSlides(this.slideIndex)
  }
}
</script>

<style lang="scss" scoped>

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  margin-top: -50px;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
}


.row:after {
  content: "";
  display: table;
  clear: both;
}


/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
</style>
