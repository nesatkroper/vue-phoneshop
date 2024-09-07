<template>
  <div>
    <h1>Name is {{ userStore.user.name }}</h1>
    <Calendar />
    <Calendar />
  </div>
</template>

<script lang="ts" setup>
import { Calendar } from "@/components/ui/calendar";
import { useUserStore } from "~/stores/user";
const userStore = useUserStore();
</script>
