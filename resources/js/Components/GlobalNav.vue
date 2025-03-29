<template>
    <nav class="fixed top-0 left-0 right-0 h-12 bg-background border-b border-border z-50">
        <div class="flex items-center justify-between h-full px-4">
            <!-- Logo and Brand -->
            <div class="flex items-center">
                <Link href="/" class="flex items-center">
                    <img src="/infinity-logo.svg" alt="Logo" class="h-7 w-7" />
                </Link>
                <span class="ml-2 text-sm font-bold text-foreground">NOQA</span>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- Dark Mode Toggle -->
                <button
                    class="p-1.5 rounded-md hover:bg-accent hover:text-accent-foreground"
                    @click="toggleDarkMode"
                >
                    <Sun v-if="isDark" class="w-4 h-4" />
                    <Moon v-else class="w-4 h-4" />
                </button>

                <!-- Current Project -->
                <div class="text-sm font-medium text-foreground">
                    {{ currentProject }}
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { Link } from '@inertiajs/vue3'
import { Sun, Moon } from 'lucide-vue-next'

const props = defineProps({
    currentProject: {
        type: String,
        required: true
    }
})

const isDark = ref(false)

const toggleDarkMode = () => {
    isDark.value = !isDark.value
    updateTheme()
}

const updateTheme = () => {
    // Update the document class
    if (isDark.value) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
    // Store the preference
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light')
}

onMounted(() => {
    // Check for saved theme preference or system preference
    const savedTheme = localStorage.getItem('theme')
    if (savedTheme) {
        isDark.value = savedTheme === 'dark'
    } else {
        isDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches
    }
    updateTheme()
})
</script>
