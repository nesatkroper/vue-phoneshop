<script setup lang="ts">
import "animate.css";
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import Sidebar from "./components/Sidebar.vue";
</script>

<template>
  <div class="overflow-auto no-scrollbar">
    <Header />
    <div class="flex flex-col">
      <Sidebar />
      <div class="mt-14 mb-14 lg:ms-64 ms-0 py-8">
        <router-view />
      </div>
    </div>
    <Footer />
  </div>
</template>

<style></style>
