<script setup lang="ts">
import { ref } from "vue";
import Input from "./components/FormInput/input.vue";
import Data from "./components/Data.vue";

const title = ref("Hello");
</script>

<template>
  <h1>Hello</h1>
  <Data />
</template>
