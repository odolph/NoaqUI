<template>
  <AppLayout :user="auth.user">
    <div class="space-y-8">
      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-foreground">Tasks</h1>
          <p class="text-sm text-muted-foreground">Manage your tasks and track progress</p>
        </div>
        <button @click="showTaskForm = true"
                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90">
          New Task
        </button>
      </div>

      <!-- Task Lists -->
      <div class="grid grid-cols-1 gap-6">
        <!-- In Progress Tasks -->
        <TaskList title="In Progress"
                 :tasks="inProgressTasks"
                 @update-task="updateTask"
                 @add-task="showTaskForm = true" />

        <!-- Todo Tasks -->
        <TaskList title="To Do"
                 :tasks="todoTasks"
                 @update-task="updateTask"
                 @add-task="showTaskForm = true" />

        <!-- Completed Tasks -->
        <TaskList title="Completed"
                 :tasks="completedTasks"
                 @update-task="updateTask"
                 @add-task="showTaskForm = true" />
      </div>

      <!-- Task Form Modal -->
      <Modal v-if="showTaskForm" @close="showTaskForm = false">
        <TaskForm :projects="projects"
                 :task="selectedTask"
                 @submit="handleTaskSubmit"
                 @cancel="closeTaskForm" />
      </Modal>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import TaskList from '@/Components/TaskList.vue'
import TaskForm from '@/Components/TaskForm.vue'
import Modal from '@/Components/Modal.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  auth: {
    type: Object,
    required: true
  },
  tasks: {
    type: Array,
    required: true
  },
  projects: {
    type: Array,
    required: true
  }
})

const showTaskForm = ref(false)
const selectedTask = ref(null)

// Filter tasks by status
const todoTasks = computed(() => props.tasks.filter(task => task.status === 'todo'))
const inProgressTasks = computed(() => props.tasks.filter(task => task.status === 'in_progress'))
const completedTasks = computed(() => props.tasks.filter(task => task.status === 'done'))

const form = useForm({
  title: '',
  description: '',
  status: 'todo',
  priority: 'medium',
  project_id: '',
  due_date: null
})

const handleTaskSubmit = (taskData) => {
  if (selectedTask.value) {
    form.put(route('tasks.update', selectedTask.value.id), {
      ...taskData,
      onSuccess: () => closeTaskForm()
    })
  } else {
    form.post(route('tasks.store'), {
      onSuccess: () => closeTaskForm()
    })
  }
}

const updateTask = (task) => {
  form.put(route('tasks.update', task.id), {
    ...task
  })
}

const closeTaskForm = () => {
  showTaskForm.value = false
  selectedTask.value = null
  form.reset()
}
</script>
