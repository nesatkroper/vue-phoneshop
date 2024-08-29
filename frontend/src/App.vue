<script setup lang="ts">
import Header from "./components/Header.vue";
</script>

<template>
  <div class="">
    <Header />
    <router-link to="customer">cus</router-link>|
    <router-link to="/">home</router-link>
    <hr />
    <router-view></router-view>
  </div>
</template>
