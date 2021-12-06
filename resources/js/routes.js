import Tasks from './pages/Tasks.vue';
import TasksCreate from "./pages/TasksCreate";
import TasksUpdate from "./pages/TasksUpdate";

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
  {
    name: 'task-update',
    path: '/:id/edit',
    component: TasksUpdate
  },
];
