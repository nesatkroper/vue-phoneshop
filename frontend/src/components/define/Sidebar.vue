<template>
  <div
    class="fixed mt-16 flex flex-col h-screen w-64 bg-white text-black shadow-xl hidden lg:flex space-x-4"
  >
    <!-- Logo Section -->
    <div
      class="flex items-center justify-center h-16 bg-white text-xl font-bold"
    >
      MyApp
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-2 space-y-2">
      <SidebarLink href="/" label="Dashboard" icon="mdi-view-dashboard" />
      <SidebarLink href="#" label="Settings" icon="mdi-cog" />
      <SidebarLink href="/video" label="Videos" icon="mdi-video" />
      <SidebarLink href="/profile" label="Profile" icon="mdi-account" />
      <SidebarLink href="#" label="Logout" icon="mdi-logout" />
    </nav>
  </div>
</template>

<script>
import SidebarLink from "./SidebarLink.vue";

export default {
  components: {
    SidebarLink,
  },
};
</script>
