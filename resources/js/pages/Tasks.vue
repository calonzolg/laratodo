<template>
  <div class="container mx-auto">
    <h1 class="text-4xl my-3">To Do List</h1>
    <section>
      <ul>
        <li>
          <div class="flex flex-row justify-between">
            <div>
              <span>item</span>
              <p class="truncate">
                <small class="text-gray-400">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam
                  blanditiis cumque ipsa minus quaerat quia quo velit.</small>
              </p>
            </div>
            <div class="flex flex-row space-x-2">
              <button
                class="flex items-center text-sm font-medium text-green-500 hover:text-green-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                complete
              </button>
              <button
                class="flex items-center text-sm font-medium text-blue-500 hover:text-blue-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                edit
              </button>
              <button
                class="flex items-center text-sm font-medium text-red-500 hover:text-red-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                delete
              </button>
            </div>
          </div>
        </li>
        <li v-for="task in tasks">
          <div class="flex flex-row justify-between">
            <div>
              <span>{{ task.title }}</span>
              <p class="truncate max-w-2xl">
                <small class="text-gray-400">
                  {{ task.description }}
                </small>
              </p>
            </div>
            <div class="flex flex-row space-x-2">
              <button
                class="flex items-center text-sm font-medium text-green-500 hover:text-green-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                complete
              </button>
              <button
                class="flex items-center text-sm font-medium text-blue-500 hover:text-blue-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                edit
              </button>
              <button
                class="flex items-center text-sm font-medium text-red-500 hover:text-red-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                delete
              </button>
            </div>
          </div>
        </li>
      </ul>
    </section>
  </div>
</template>

<script>
export default {
  name: "Tasks",
  data() {
    return {
      tasks: []
    };
  },
  mounted() {
    axios('api/tasks').then(response => this.tasks = response.data.tasks)
  }
}
</script>

<style scoped>

</style>
