<template>
    <div
        class="fixed inset-y-0 right-0 w-96 bg-card border-l border-border transform transition-transform duration-200 ease-in-out"
        :class="[isOpen ? 'translate-x-0' : 'translate-x-full']"
    >
        <div class="h-full flex flex-col">
            <!-- Header -->
            <div class="p-4 border-b border-border">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-semibold text-foreground">Task Details</h2>
                    <button
                        @click="$emit('close')"
                        class="p-1.5 rounded-md hover:bg-accent hover:text-accent-foreground"
                    >
                        <X class="w-4 h-4" />
                    </button>
                </div>
                <!-- Button Group -->
                <div class="flex items-center justify-end gap-2 pt-1">
                    <div class="flex items-center rounded-md border border-border bg-background shadow-sm">
                        <button
                            class="p-1.5 hover:bg-accent hover:text-accent-foreground rounded-l-md border-r border-border"
                            title="Edit task"
                        >
                            <Pencil class="w-4 h-4" />
                        </button>
                        <button
                            class="p-1.5 hover:bg-accent hover:text-accent-foreground border-r border-border"
                            title="More options"
                        >
                            <MoreHorizontal class="w-4 h-4" />
                        </button>
                        <button
                            class="p-1.5 hover:bg-accent hover:text-accent-foreground rounded-r-md"
                            title="Delete task"
                        >
                            <Trash class="w-4 h-4" />
                        </button>
                    </div>
                    <button
                        class="p-1.5 rounded-md border border-border hover:bg-accent hover:text-accent-foreground bg-background shadow-sm"
                        title="Close panel"
                        @click="$emit('close')"
                    >
                        <X class="w-4 h-4" />
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 p-4 overflow-y-auto">
                <div v-if="task" class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="text-sm font-medium text-muted-foreground">Title</label>
                        <h3 class="text-foreground mt-1">{{ task.title }}</h3>
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="text-sm font-medium text-muted-foreground">Priority</label>
                        <div class="mt-1">
                            <select
                                id="priority"
                                v-model="selectedPriority"
                                @change="updatePriority"
                                class="w-full rounded-md border border-border bg-background px-3 py-2 text-sm ring-offset-background"
                            >
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <div class="mt-2 flex items-center">
                            <span
                                :class="[
                                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                    selectedPriority === 'High' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                    selectedPriority === 'Medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                ]"
                            >
                                {{ selectedPriority }}
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="text-sm font-medium text-muted-foreground">Description</label>
                        <p class="mt-1 text-foreground">{{ task.description }}</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="text-sm font-medium text-muted-foreground">Status</label>
                        <div class="mt-1 flex items-center">
                            <div class="h-3 w-3 rounded-full mr-2"
                                :class="[
                                    task.status === 'In Progress' ? 'bg-yellow-500' : 'bg-gray-300'
                                ]"
                            ></div>
                            <span class="text-foreground">{{ task.status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { X, Pencil, MoreHorizontal, Trash } from 'lucide-vue-next'

const props = defineProps({
    task: {
        type: Object,
        required: true
    },
    isOpen: {
        type: Boolean,
        required: true
    }
})

const emit = defineEmits(['close', 'updatePriority'])

const selectedPriority = ref(props.task?.priority || 'Low')

// Watch for task changes to update the selected priority
watch(() => props.task, (newTask) => {
    if (newTask) {
        selectedPriority.value = newTask.priority
    }
}, { immediate: true })

const updatePriority = () => {
    emit('updatePriority', {
        taskId: props.task.id,
        priority: selectedPriority.value
    })
}
</script>
