<script setup lang="ts">
defineProps(["modelValue"]);
defineEmits(["update:modelValue"]);
</script>

<template>
  <input
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    class="form-control col-md-3"
  />
</template>
