<template>
  <div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <nav class="hidden fixed top-0 right-0 px-6 py-4 sm:block space-x-4">
      <router-link to="/" class="text-gray-500 hover:text-gray-800">To Do List</router-link>
      <router-link to="/create" class="text-gray-500 hover:text-gray-800">Create Item</router-link>
    </nav>

    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "App"
}
</script>
