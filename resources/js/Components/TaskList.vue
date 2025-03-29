<template>
  <div class="space-y-4">
    <!-- Task List Header -->
    <div class="flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <h2 class="text-lg font-semibold text-foreground">{{ title }}</h2>
        <span class="text-sm text-muted-foreground">{{ tasks.length }} tasks</span>
      </div>
      <button @click="$emit('add-task')"
              class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90">
        Add Task
      </button>
    </div>

    <!-- Task List -->
    <div class="bg-card rounded-lg border border-border">
      <div class="divide-y divide-border">
        <div v-for="task in tasks" :key="task.id" class="p-4 hover:bg-accent/50 transition-colors">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
              <!-- Status Icon -->
              <button @click="toggleTaskStatus(task)"
                      class="w-5 h-5 rounded-full border-2"
                      :class="{
                        'border-green-500 bg-green-500': task.status === 'done',
                        'border-yellow-500': task.status === 'in_progress',
                        'border-gray-300': task.status === 'todo'
                      }">
              </button>

              <!-- Task Title and Identifier -->
              <div>
                <div class="flex items-center space-x-2">
                  <span class="text-sm font-medium text-foreground">{{ task.title }}</span>
                  <span class="text-xs text-muted-foreground">{{ task.task_identifier }}</span>
                </div>
                <p v-if="task.description" class="text-sm text-muted-foreground line-clamp-1">
                  {{ task.description }}
                </p>
              </div>
            </div>

            <!-- Task Meta -->
            <div class="flex items-center space-x-4">
              <!-- Priority Badge -->
              <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full"
                    :class="{
                      'bg-red-100 text-red-700': task.priority === 'high',
                      'bg-yellow-100 text-yellow-700': task.priority === 'medium',
                      'bg-gray-100 text-gray-700': task.priority === 'low'
                    }">
                {{ task.priority }}
              </span>

              <!-- Due Date -->
              <span v-if="task.due_date" class="text-sm text-muted-foreground">
                {{ formatDate(task.due_date) }}
              </span>

              <!-- Assignee -->
              <div v-if="task.user" class="flex items-center">
                <img :src="task.user.avatar" :alt="task.user.name"
                     class="w-6 h-6 rounded-full">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'
import { format } from 'date-fns'

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  tasks: {
    type: Array,
    required: true
  }
})

const emit = defineEmits(['update-task', 'add-task'])

const toggleTaskStatus = (task) => {
  const newStatus = task.status === 'done' ? 'todo' :
                   task.status === 'todo' ? 'in_progress' : 'done'

  emit('update-task', {
    ...task,
    status: newStatus
  })
}

const formatDate = (date) => {
  return format(new Date(date), 'MMM d')
}
</script>
