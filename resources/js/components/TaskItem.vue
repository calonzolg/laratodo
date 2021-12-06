<template>
  <div class="flex flex-row justify-between">
    <div :class="task.completed_at ? `line-through` : ``">
      <span>{{ task.title }}</span>
      <p class="truncate max-w-2xl">

        <small class="text-gray-400">
          description: {{ task.description }}
        </small>
      </p>
    </div>
    <div class="flex flex-row space-x-2">
      <button
        class="flex items-center text-sm font-medium text-green-500 hover:text-green-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
        @click="completeItem(task.id)"
        v-if="!task.completed_at"
      >
        complete
      </button>
      <button
        class="flex items-center text-sm font-medium text-blue-500 hover:text-blue-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
        @click="editItem(task.id)"
        v-if="!task.completed_at"
      >
        edit
      </button>
      <button
        class="flex items-center text-sm font-medium text-red-500 hover:text-red-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
        @click="deleteItem(task.id)"
      >
        delete
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "TaskItem",
  props: {
    task: {type: Object, require: true}
  },
  methods: {
    completeItem(id) {
      if (window.confirm(`Are you sure you want complete this item?`)) {
        axios.patch(`/api/tasks/${this.task.id}`)
          .then(res => {
            this.task.completed_at = res.data.task.completed_at;
          });
      } else {
        return null;
      }
    },
    editItem(id) {
      this.$router.push(`/${id}/edit`)
    },
    deleteItem(id) {
      axios.delete(`/api/tasks/${id}`)
        .then(response =>
          this.$emit('deletedTask', response.data.taskId)
        )
    }
  }
}
</script>

<style scoped>

</style>
