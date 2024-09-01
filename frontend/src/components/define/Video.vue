<template>
  <iframe
    :src="handleKey(link)"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen
    class="rounded-2xl m-auto max-w-[720px] max-h-[480px] p-0 w-full h-full aspect-video mb-5"
  >
  </iframe>
</template>

<script setup lang="ts">
defineProps({
  link: {
    type: String,
  },
});

const handleKey = (
  url: string = "https://www.youtube.com/watch?v=35KDnej1hlI"
) => {
  let key = url.split("=")[1];
  console.log(key);
  return `https://www.youtube.com/embed/${key}`;
};
</script>
