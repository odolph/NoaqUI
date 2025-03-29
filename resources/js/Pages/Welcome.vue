<template>
    <div class="min-h-screen bg-background">
        <GlobalNav :current-project="currentProject" />

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-card border-r border-border mt-12">
            <div class="flex flex-col h-full">
                <!-- Navigation -->
                <nav class="flex-1 px-2 py-4 space-y-1">
                    <!-- Projects Section -->
                    <div class="mb-3">
                        <h2 class="px-3 text-sm font-medium text-muted-foreground mb-1">Projects</h2>
                        <div class="space-y-1">
                            <a href="#" class="flex items-center px-3 py-1.5 text-sm rounded-md bg-accent text-accent-foreground">
                                <LayoutGrid class="w-4 h-4 mr-2" />
                                <span>Website Redesign</span>
                            </a>
                            <a href="#" class="flex items-center px-3 py-1.5 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                                <Smartphone class="w-4 h-4 mr-2" />
                                <span>Mobile App</span>
                            </a>
                        </div>
                    </div>

                    <!-- Views Section -->
                    <div class="mb-3">
                        <h2 class="px-3 text-sm font-medium text-muted-foreground mb-1">Views</h2>
                        <div class="space-y-1">
                            <a href="#" class="flex items-center px-3 py-1.5 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                                <ListTodo class="w-4 h-4 mr-2" />
                                <span>All Tasks</span>
                            </a>
                            <a href="#" class="flex items-center px-3 py-1.5 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                                <Activity class="w-4 h-4 mr-2" />
                                <span>Active</span>
                            </a>
                            <a href="#" class="flex items-center px-3 py-1.5 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                                <Inbox class="w-4 h-4 mr-2" />
                                <span>Backlog</span>
                            </a>
                        </div>
                    </div>

                    <!-- Test Suites Section -->
                    <div class="mb-3">
                        <h2 class="px-3 text-sm font-medium text-muted-foreground mb-1">Test Suites</h2>
                        <div class="space-y-1">
                            <a href="#" class="flex items-center px-3 py-1.5 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                                <ListTodo class="w-4 h-4 mr-2" />
                                <span>Regression Tests</span>
                            </a>
                            <a href="#" class="flex items-center px-3 py-1.5 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                                <Activity class="w-4 h-4 mr-2" />
                                <span>Integration Tests</span>
                            </a>
                            <a href="#" class="flex items-center px-3 py-1.5 text-sm rounded-md hover:bg-accent hover:text-accent-foreground">
                                <Inbox class="w-4 h-4 mr-2" />
                                <span>Performance Tests</span>
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- User Profile -->
                <div class="p-4 border-t border-border">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-accent"></div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-foreground">Demo User</p>
                            <p class="text-xs text-muted-foreground">demo@example.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="pl-64 pt-12">
            <div class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-foreground">Test Cases</h1>
                        <p class="text-sm text-muted-foreground">Manage your test cases and track progress</p>
                    </div>
                    <button class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md bg-[#5E6AD2] text-white hover:bg-[#5E6AD2]/90">
                        <Plus class="w-4 h-4 mr-2" />
                        New Test Case
                    </button>
                </div>

                <!-- Task Lists -->
                <div class="space-y-5">
                    <!-- In Progress -->
                    <div class="bg-card rounded-lg border border-border p-3">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-lg font-semibold text-foreground">In Progress</h2>
                            <span class="text-sm text-muted-foreground">{{ tasks.inProgress.length }} tasks</span>
                        </div>
                        <div class="space-y-1.5">
                            <template v-for="task in tasks.inProgress" :key="task.id">
                                <!-- Parent Task -->
                                <div
                                    class="p-2 bg-background rounded-md hover:bg-accent/50 transition-colors cursor-pointer group"
                                    @click="toggleTask(task.id)"
                                >
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="h-4 w-4 rounded-full border-2 border-yellow-500"></div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-medium text-foreground">{{ task.title }}</span>
                                                <span
                                                    :class="[
                                                        'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium',
                                                        task.priority === 'High' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                                        task.priority === 'Medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                    ]"
                                                >
                                                    {{ task.priority }}
                                                </span>
                                            </div>
                                        </div>
                                        <ChevronDown
                                            class="w-4 h-4 text-muted-foreground transition-transform duration-200"
                                            :class="{ 'rotate-180': !collapsedTasks[task.id] }"
                                        />
                                    </div>
                                </div>
                                <!-- Nested Tasks -->
                                <Transition
                                    enter-active-class="transition duration-200 ease-out"
                                    enter-from-class="transform scale-y-95 opacity-0"
                                    enter-to-class="transform scale-y-100 opacity-100"
                                    leave-active-class="transition duration-200 ease-in"
                                    leave-from-class="transform scale-y-100 opacity-100"
                                    leave-to-class="transform scale-y-95 opacity-0"
                                >
                                    <div v-show="!collapsedTasks[task.id]" class="ml-7 space-y-1.5 border-l-2 border-border pl-4">
                                        <div v-for="subtask in task.subtasks"
                                             :key="subtask.id"
                                             @click="openTaskDetails(subtask)"
                                             class="p-2 bg-background rounded-md hover:bg-accent/50 transition-colors cursor-pointer"
                                        >
                                            <div class="flex items-center gap-3">
                                                <div class="h-4 w-4 rounded-full border-2 border-yellow-500"></div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm font-medium text-foreground">{{ subtask.title }}</span>
                                                    <span
                                                        :class="[
                                                            'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium',
                                                            subtask.priority === 'High' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                                            subtask.priority === 'Medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                        ]"
                                                    >
                                                        {{ subtask.priority }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </Transition>
                            </template>
                        </div>
                    </div>

                    <!-- Todo -->
                    <div class="bg-card rounded-lg border border-border p-3">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-lg font-semibold text-foreground">Todo</h2>
                            <span class="text-sm text-muted-foreground">{{ tasks.todo.length }} tasks</span>
                        </div>
                        <div class="space-y-1.5">
                            <template v-for="task in tasks.todo" :key="task.id">
                                <!-- Parent Task -->
                                <div
                                    class="p-2 bg-background rounded-md hover:bg-accent/50 transition-colors cursor-pointer group"
                                    @click="toggleTask(task.id)"
                                >
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="h-4 w-4 rounded-full border-2 border-gray-300"></div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-medium text-foreground">{{ task.title }}</span>
                                                <span
                                                    :class="[
                                                        'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium',
                                                        task.priority === 'High' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                                        task.priority === 'Medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                    ]"
                                                >
                                                    {{ task.priority }}
                                                </span>
                                            </div>
                                        </div>
                                        <ChevronDown
                                            class="w-4 h-4 text-muted-foreground transition-transform duration-200"
                                            :class="{ 'rotate-180': !collapsedTasks[task.id] }"
                                        />
                                    </div>
                                </div>
                                <!-- Nested Tasks -->
                                <Transition
                                    enter-active-class="transition duration-200 ease-out"
                                    enter-from-class="transform scale-y-95 opacity-0"
                                    enter-to-class="transform scale-y-100 opacity-100"
                                    leave-active-class="transition duration-200 ease-in"
                                    leave-from-class="transform scale-y-100 opacity-100"
                                    leave-to-class="transform scale-y-95 opacity-0"
                                >
                                    <div v-show="!collapsedTasks[task.id]" class="ml-7 space-y-1.5 border-l-2 border-border pl-4">
                                        <div v-for="subtask in task.subtasks"
                                             :key="subtask.id"
                                             @click="openTaskDetails(subtask)"
                                             class="p-2 bg-background rounded-md hover:bg-accent/50 transition-colors cursor-pointer"
                                        >
                                            <div class="flex items-center gap-3">
                                                <div class="h-4 w-4 rounded-full border-2 border-gray-300"></div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm font-medium text-foreground">{{ subtask.title }}</span>
                                                    <span
                                                        :class="[
                                                            'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium',
                                                            subtask.priority === 'High' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                                            subtask.priority === 'Medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                        ]"
                                                    >
                                                        {{ subtask.priority }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </Transition>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Task Details Panel -->
        <TaskDetails
            :task="selectedTask"
            :is-open="isTaskDetailsOpen"
            @close="closeTaskDetails"
            @update-priority="handlePriorityUpdate"
        />
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { LayoutGrid, Smartphone, ListTodo, Activity, Inbox, Plus, ChevronDown } from 'lucide-vue-next'
import GlobalNav from '@/Components/GlobalNav.vue'
import TaskDetails from '@/Components/TaskDetails.vue'

const currentProject = 'Website Redesign'

const collapsedTasks = ref({
    auth: false,
    api: false,
    design: false,
    testing: false
})

const toggleTask = (taskId) => {
    collapsedTasks.value[taskId] = !collapsedTasks.value[taskId]
}

// Task details state
const selectedTask = ref(null)
const isTaskDetailsOpen = ref(false)

const openTaskDetails = (task) => {
    selectedTask.value = task
    isTaskDetailsOpen.value = true
}

const closeTaskDetails = () => {
    isTaskDetailsOpen.value = false
    // Clear the selected task after animation completes
    setTimeout(() => {
        selectedTask.value = null
    }, 200)
}

// Sample tasks data
const tasks = {
    inProgress: [
        {
            id: 'auth',
            title: 'Authentication System',
            description: 'Implement a secure authentication system with support for multiple providers and password reset functionality.',
            priority: 'High',
            status: 'In Progress',
            subtasks: [
                {
                    id: 'oauth',
                    title: 'Implement OAuth providers',
                    description: 'Add support for Google, GitHub, and Twitter OAuth authentication.',
                    priority: 'Medium',
                    status: 'In Progress'
                },
                {
                    id: 'reset',
                    title: 'Add password reset flow',
                    description: 'Implement secure password reset functionality with email verification.',
                    priority: 'High',
                    status: 'In Progress'
                }
            ]
        },
        {
            id: 'api',
            title: 'API Integration',
            description: 'Set up RESTful API endpoints for the application.',
            priority: 'Medium',
            status: 'In Progress',
            subtasks: [
                {
                    id: 'endpoints',
                    title: 'Set up API endpoints',
                    description: 'Create RESTful endpoints following Laravel best practices.',
                    priority: 'Medium',
                    status: 'In Progress'
                }
            ]
        }
    ],
    todo: [
        {
            id: 'design',
            title: 'Design System',
            description: 'Create a comprehensive design system for the application.',
            priority: 'Medium',
            status: 'Todo',
            subtasks: [
                {
                    id: 'components',
                    title: 'Create component library',
                    description: 'Build a reusable component library with documentation.',
                    priority: 'Low',
                    status: 'Todo'
                },
                {
                    id: 'dark-mode',
                    title: 'Design dark mode variants',
                    description: 'Create dark mode versions of all components.',
                    priority: 'Medium',
                    status: 'Todo'
                },
                {
                    id: 'docs',
                    title: 'Document usage guidelines',
                    description: 'Write comprehensive documentation for the design system.',
                    priority: 'Low',
                    status: 'Todo'
                }
            ]
        },
        {
            id: 'testing',
            title: 'Testing Infrastructure',
            description: 'Set up comprehensive testing infrastructure.',
            priority: 'High',
            status: 'Todo',
            subtasks: [
                {
                    id: 'unit',
                    title: 'Set up unit testing',
                    description: 'Configure PHPUnit and write initial test suite.',
                    priority: 'High',
                    status: 'Todo'
                },
                {
                    id: 'e2e',
                    title: 'Configure E2E tests',
                    description: 'Set up end-to-end testing with Cypress.',
                    priority: 'Medium',
                    status: 'Todo'
                }
            ]
        }
    ]
}

const handlePriorityUpdate = ({ taskId, priority }) => {
    // Find the task in either inProgress or todo lists
    const lists = ['inProgress', 'todo']

    lists.forEach(list => {
        tasks[list].forEach(task => {
            // Update parent task priority if it matches
            if (task.id === taskId) {
                task.priority = priority
            }
            // Check subtasks
            task.subtasks?.forEach(subtask => {
                if (subtask.id === taskId) {
                    subtask.priority = priority
                }
            })
        })
    })
}

defineProps({
    appName: {
        type: String,
        required: true
    }
})
</script>
