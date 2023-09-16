<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center justify-center w-6 h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 text-center bg-white border border-gray-300 rounded-md font-semibold text-[10px] sm:text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">/
        <slot />
    </button>
</template>
