import Tasks from './pages/Tasks.vue';
import TasksCreate from "./pages/TasksCreate";

export const routes = [
  {
    name: 'task',
    path: '/',
    component: Tasks
  },
  {
    name: 'task-create',
    path: '/create',
    component: TasksCreate
  },
];
