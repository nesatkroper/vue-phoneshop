<!-- <template>
  <nav class="bg-gray-800 text-white shadow-md">
    <div class="container mx-auto flex items-center justify-between px-4 py-3">

      <div class="text-2xl font-semibold">
        <RouterLink to="/" class="text-white hover:text-gray-300"
          >MyApp</RouterLink
        >
      </div>

      <div class="hidden md:flex space-x-4">
        <RouterLink to="/" class="hover:text-gray-300">Home</RouterLink>
        <RouterLink to="/about" class="hover:text-gray-300">About</RouterLink>
        <RouterLink to="/customer" class="hover:text-gray-300"
          >Customer</RouterLink
        >
        <RouterLink to="/contact" class="hover:text-gray-300"
          >Contact</RouterLink
        >
      </div>
      <button @click="toggleMenu" class="md:hidden text-white">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16m-7 6h7"
          ></path>
        </svg>
      </button>
    </div>
    <div v-show="isMenuOpen" class="md:hidden bg-gray-700">
      <RouterLink to="/" class="block px-4 py-2 text-white hover:bg-gray-600"
        >Home</RouterLink
      >
      <RouterLink
        to="/about"
        class="block px-4 py-2 text-white hover:bg-gray-600"
        >About</RouterLink
      >
      <RouterLink
        to="/services"
        class="block px-4 py-2 text-white hover:bg-gray-600"
        >Services</RouterLink
      >
      <RouterLink
        to="/contact"
        class="block px-4 py-2 text-white hover:bg-gray-600"
        >Contact</RouterLink
      >
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
  data() {
    return {
      isMenuOpen: false,
    };
  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    },
  },
};
</script>

<style scoped>
/* Add any additional styles here if needed */
</style> -->

<template>
  <nav class="flex items-center justify-between p-4 bg-white shadow-md">
    <!-- Left side - Logo -->
    <div class="flex items-center space-x-4">
      <div class="font-semibold text-lg text-gray-800">/shadcn-vue</div>
      <div class="flex space-x-4">
        <a href="#" class="text-gray-600 hover:text-gray-800">Docs</a>
        <a href="#" class="text-gray-600 hover:text-gray-800">Components</a>
        <a href="#" class="text-gray-600 hover:text-gray-800">Themes</a>
        <a href="#" class="text-gray-600 hover:text-gray-800">Examples</a>
        <a href="#" class="text-gray-600 hover:text-gray-800">Blocks</a>
      </div>
    </div>

    <!-- Center - Search Bar -->
    <div class="relative w-1/3">
      <input
        type="text"
        placeholder="Search..."
        class="w-full p-2 pl-8 pr-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />
      <div class="absolute left-2 top-2 text-gray-400">
        <!-- Keyboard shortcut hint -->
        <kbd class="px-2 py-1 text-xs border rounded bg-gray-100">⌘ K</kbd>
      </div>
    </div>

    <!-- Right side - Icons -->
    <div class="flex items-center space-x-4 text-gray-600">
      <!-- Icons (Replace with actual icon components if needed) -->
      <button class="hover:text-gray-800">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M5 13l4 4L19 7"
          ></path>
        </svg>
      </button>
      <button class="hover:text-gray-800">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M5 13l4 4L19 7"
          ></path>
        </svg>
      </button>
      <button class="hover:text-gray-800">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M5 13l4 4L19 7"
          ></path>
        </svg>
      </button>
    </div>
  </nav>
</template>

<script setup>
// No additional script required for this basic implementation
</script>

<style scoped>
/* Add custom styles here if needed */
</style>
