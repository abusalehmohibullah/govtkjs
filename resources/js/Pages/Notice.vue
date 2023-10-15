<script setup>

import GeneralLayout from '@/Layouts/GeneralLayout.vue';
import { computed } from 'vue';

// Define a list of color names
const colorNames = ['red', 'pink', 'violet', 'blue', 'green', 'yellow', 'orange', 'paste'];

// Create a computed property to generate a random color name
const randomColorName = computed(() => {
    const randomIndex = Math.floor(Math.random() * colorNames.length);
    return colorNames[randomIndex];
});

defineProps({
    notice: Object,
});

</script>

<template>
    <GeneralLayout>
        <div class="container p-5">
            <div class="bg-white p-8 relative rotate-[-2deg] shadow-lg drop-shadow-lg mt-2 mb-5">
                <div class="text-2xl font-bold">{{ notice.title }}</div>
                <div class="text-base">{{ notice.content }}</div>
                <iframe :src="notice.attachment" width="100%" height="700px"></iframe>
                <img :src="`../assets/images/pin/${randomColorName}-pin.png`" alt=""
                        class="h-8 absolute top-1 left-1/2 drop-shadow-xl">
            </div>
        </div>
    </GeneralLayout>
</template>

