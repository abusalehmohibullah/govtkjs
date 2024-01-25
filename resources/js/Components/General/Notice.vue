<script setup>

import { Link } from '@inertiajs/vue3';
import { ref, watchEffect, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const page = usePage();
const show = ref(true);
const style = ref('success');
const message = ref('');

watchEffect(async () => {
    style.value = page.props.jetstream.flash?.bannerStyle || 'success';
    message.value = page.props.jetstream.flash?.banner || '';
    show.value = true;
});

// Define props
const { notices } = defineProps(['notices']);


// Define a list of color names
const colorNames = ['red', 'pink', 'violet', 'blue', 'green', 'yellow', 'orange', 'paste'];

// Define a ref to store the rotation angles

// Create an array of computed properties to generate random color names for each notice
const randomColorNames = computed(() => {
    return notices.map(() => {
        const randomIndex = Math.floor(Math.random() * colorNames.length);
        return colorNames[randomIndex];
    });
});

const rotationAngles = ref([]);

// Populate the rotationAngles array with random angles for each item
for (let i = 0; i < notices.length; i++) {
    rotationAngles.value.push((Math.random() * 3 - 2).toFixed(2)); // Generates angles between -2 and 2 degrees
}


// Create a function to get the rotation style for a specific item
const getRotationStyle = (index) => {
    return {
        transform: `rotate(${rotationAngles.value[index]}deg)`,
    };
};

// Create a function to format the date as "1 January, 2023"
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const day = date.getDate();
    const month = date.toLocaleString('default', { month: 'long' });
    const year = date.getFullYear();
    return `${day} ${month}, ${year}`;
};

const share = (notice) => {
    if (navigator.share) {
        navigator.share({
            url: route('notice.show', { slug: notice.slug }),
            title: notice.title,
        })
    } else {
        navigator.clipboard.writeText(route('notice.show', { slug: notice.slug }))
    }
}
</script>


<template>
    <!-- Notice Board Frame -->
    <div class="border-8 sm:border-[15px] border-[#7c3511] drop-shadow-md my-5">
        <div class="border-4 border-[#4d2410] p-4 shadow-inner">
            <h1 class="text-2xl md:text-md font-semibold mb-4 text-center">Notice Board</h1>
            <Link :href="route('notices.index')" class="absolute top-4 right-3">
            <SecondaryButton>
                See all
            </SecondaryButton>
            </Link>
            <!-- Notice items -->
            <div class="columns-2 lg:columns-3 gap-5">
                <!-- Notice 1 -->
                <div v-for="(notice, index) in notices" :style="getRotationStyle(index)"
                    class="rotating-div break-inside-avoid-column first:mt-0 mt-5">
                    <Link :href="route('notice.show', { slug: notice.slug })">
                    <div class="bg-white p-4 relative shadow-sm hover:drop-shadow-xl"
                        :class="{ 'pb-10': notice.attachment }">
                        <h2 class="text-lg font-semibold text-center">{{ notice.heading }}</h2>
                        <div class="text-end text-muted"><small>{{ formatDate(notice.published_on) }}</small></div>
                        <p class="text-sm text-gray-600">{{ notice.title }}</p>
                        <img :src="`assets/images/pin/${randomColorNames[index]}-pin.png`" alt=""
                            class="h-3 absolute top-1 left-1/2 drop-shadow-xl">
                    </div>
                    </Link>
                    <div v-if="notice.attachment" class="flex gap-2 justify-center mt-3 absolute bottom-1 right-1">

                        <a :href="'/storage/' + notice.attachment" target="_blank">
                            <i
                                class="fa-solid fa-paperclip px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                        </a>
                        <a :href="route('notice.download', notice.id)">
                            <i
                                class="fa-solid fa-download px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                        </a>
                        <button @click="share(notice)">
                            <i
                                class="fa-solid fa-share px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



  