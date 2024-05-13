<template>
  <swiper :pagination="pagination" :modules="modules" class="mySwiper">
    <swiper-slide class="pb-10 pt-10">Slide 1</swiper-slide>
    <swiper-slide class="pb-10 pt-10">Slide 2</swiper-slide>
    <swiper-slide class="pb-10 pt-10">Slide 3</swiper-slide>
    <swiper-slide class="pb-10 pt-10">Slide 4</swiper-slide>
    <swiper-slide class="pb-10 pt-10">Slide 5</swiper-slide>
    <swiper-slide class="pb-10 pt-10">Slide 6</swiper-slide>
    <swiper-slide class="pb-10 pt-10">Slide 7</swiper-slide>
    <swiper-slide class="pb-10 pt-10">Slide 8</swiper-slide>
    <swiper-slide class="pb-10 pt-10">Slide 9</swiper-slide>
  </swiper>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/pagination";

import "../../css/style.css";

// import required modules
import { Pagination } from "swiper";

export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    return {
      pagination: {
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
      },
      modules: [Pagination],
    };
  },
};
</script>
