<template>
  <div class="min-h-screen bg-background">
    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 w-64 bg-card border-r border-border">
      <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="p-4">
          <h1 class="text-xl font-semibold text-foreground">Task Manager</h1>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 space-y-1">
          <!-- Projects Section -->
          <div class="mb-4">
            <h2 class="px-3 text-sm font-medium text-muted-foreground mb-2">Projects</h2>
            <ul class="space-y-1">
              <li v-for="project in projects" :key="project.id">
                <a :href="route('projects.show', project.id)"
                   class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-accent hover:text-accent-foreground"
                   :class="{ 'bg-accent text-accent-foreground': route().current('projects.show', project.id) }">
                  <span class="truncate">{{ project.name }}</span>
                </a>
              </li>
            </ul>
          </div>

          <!-- Views Section -->
          <div class="mb-4">
            <h2 class="px-3 text-sm font-medium text-muted-foreground mb-2">Views</h2>
            <ul class="space-y-1">
              <li>
                <a href="#" class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                  <span class="truncate">All Tasks</span>
                </a>
              </li>
              <li>
                <a href="#" class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                  <span class="truncate">Active</span>
                </a>
              </li>
              <li>
                <a href="#" class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                  <span class="truncate">Backlog</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- User Profile -->
        <div class="p-4 border-t border-border">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img class="h-8 w-8 rounded-full" :src="user.avatar" alt="">
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium text-foreground">{{ user.name }}</p>
              <p class="text-xs text-muted-foreground">{{ user.email }}</p>
            </div>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="pl-64">
      <div class="p-8">
        <slot></slot>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  user: {
    type: Object,
    required: true
  }
})

const projects = ref([
  { id: 1, name: 'Project A' },
  { id: 2, name: 'Project B' },
  { id: 3, name: 'Project C' },
])
</script>
