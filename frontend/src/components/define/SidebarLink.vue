<template>
  <RouterLink
    :to="href"
    class="flex items-center px-4 py-2 text-gray-400 hover:bg-gray-700 hover:text-white rounded-md"
  >
    <i :class="`mdi ${icon} text-xl mr-3`"></i>
    <span>{{ label }}</span>
  </RouterLink>
</template>

<script>
export default {
  props: {
    href: String,
    label: String,
    icon: String,
  },
};
</script>
