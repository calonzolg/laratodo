<template>
  <task-form :task="task"></task-form>
</template>

<script>
import TaskForm from "../components/TaskForm";

export default {
  name: "TasksUpdate",
  components: {
    'task-form': TaskForm
  },
  data() {
    return {
      task: {}
    }
  },
  mounted() {
    axios(`/api/tasks/${this.$route.params.id}`).then(response => this.task = response.data.task)
  }
}
</script>

<style scoped>

</style>
