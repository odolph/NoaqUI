<template>
  <div class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-background/80 backdrop-blur-sm" @click="$emit('close')"></div>

    <!-- Modal Content -->
    <div class="relative bg-background rounded-lg shadow-lg w-full max-w-lg mx-4 z-50">
      <div class="p-6">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
defineEmits(['close'])
</script>
