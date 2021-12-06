<template>
  <div class="container mx-auto">
    <h1 class="text-4xl my-3">To Do List</h1>
    <section>
      <ul v-if="tasks.length !== 0">
        <li v-for="task in tasks" class="rounded bg-white p-2">
          <task-item
            :task="task"
            @deletedTask="handleDeletedItem"
          />
        </li>
      </ul>
      <p v-else>
        The list is empty
      </p>
    </section>
  </div>
</template>

<script>
import TaskItem from "../components/TaskItem";

export default {
  name: "Tasks",
  components: {
    'task-item': TaskItem,
  },
  data() {
    return {
      tasks: []
    };
  },
  mounted() {
    axios('api/tasks').then(response => this.tasks = response.data.tasks)
  },
  methods: {
    handleDeletedItem(id) {
      this.tasks = this.tasks.filter(task => task.id !== id)
    }
  }
}
</script>

<style scoped>

</style>
