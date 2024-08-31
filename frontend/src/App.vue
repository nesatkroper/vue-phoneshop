<script setup lang="ts">
import "animate.css";
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
</script>

<template>
  <div class="overflow-auto scrollbar-hide">
    <Header />
    <div
      class="animate__animated animate__fadeInDown animate__delay-0.5s mt-20"
    >
      <router-view />
    </div>
    <Footer />
  </div>
</template>

<style>
/* In your global CSS or a custom Tailwind CSS file */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

/* Optional: For Firefox */
.scrollbar-hide {
  scrollbar-width: none; /* Firefox */
}
</style>
