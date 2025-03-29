<template>
  <div class="bg-card rounded-lg border border-border p-6">
    <form @submit.prevent="handleSubmit">
      <!-- Title -->
      <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-foreground mb-1">Title</label>
        <input type="text" id="title" v-model="form.title"
               class="w-full rounded-md border-border bg-background text-foreground"
               required>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-foreground mb-1">Description</label>
        <textarea id="description" v-model="form.description" rows="3"
                  class="w-full rounded-md border-border bg-background text-foreground"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-4 mb-4">
        <!-- Status -->
        <div>
          <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
          <select id="status" v-model="form.status"
                  class="w-full rounded-md border-border bg-background text-foreground">
            <option value="todo">To Do</option>
            <option value="in_progress">In Progress</option>
            <option value="done">Done</option>
          </select>
        </div>

        <!-- Priority -->
        <div>
          <label for="priority" class="block text-sm font-medium text-foreground mb-1">Priority</label>
          <select id="priority" v-model="form.priority"
                  class="w-full rounded-md border-border bg-background text-foreground">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4 mb-6">
        <!-- Project -->
        <div>
          <label for="project" class="block text-sm font-medium text-foreground mb-1">Project</label>
          <select id="project" v-model="form.project_id"
                  class="w-full rounded-md border-border bg-background text-foreground"
                  required>
            <option v-for="project in projects" :key="project.id" :value="project.id">
              {{ project.name }}
            </option>
          </select>
        </div>

        <!-- Due Date -->
        <div>
          <label for="due_date" class="block text-sm font-medium text-foreground mb-1">Due Date</label>
          <input type="datetime-local" id="due_date" v-model="form.due_date"
                 class="w-full rounded-md border-border bg-background text-foreground">
        </div>
      </div>

      <!-- Actions -->
      <div class="flex justify-end space-x-3">
        <button type="button" @click="$emit('cancel')"
                class="px-4 py-2 text-sm font-medium rounded-md bg-secondary text-secondary-foreground hover:bg-secondary/90">
          Cancel
        </button>
        <button type="submit"
                class="px-4 py-2 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90">
          {{ task ? 'Update' : 'Create' }} Task
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
  task: {
    type: Object,
    default: null
  },
  projects: {
    type: Array,
    required: true
  }
})

const emit = defineEmits(['submit', 'cancel'])

const form = ref({
  title: '',
  description: '',
  status: 'todo',
  priority: 'medium',
  project_id: '',
  due_date: null
})

onMounted(() => {
  if (props.task) {
    form.value = { ...props.task }
  }
})

const handleSubmit = () => {
  emit('submit', form.value)
}
</script>
