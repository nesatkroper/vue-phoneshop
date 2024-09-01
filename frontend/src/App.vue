<script setup lang="ts">
import "animate.css";
// @ts-ignore
import Header from "./components/define/Header.vue";
// @ts-ignore
import Footer from "./components/define/Footer.vue";
// @ts-ignore
import Sidebar from "./components/define/Sidebar.vue";
</script>

<template>
  <div class="overflow-auto no-scrollbar">
    <Header />
    <div class="flex flex-col">
      <Sidebar />
      <div class="my-16 lg:ms-64 ms-0">
        <router-view />
      </div>
    </div>
    <Footer />
  </div>
</template>

<style></style>
