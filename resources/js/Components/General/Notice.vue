<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import { ref, watchEffect, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';

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

// Define a ref to store the rotation angles
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

</script>


<template>
    <!-- Notice Board Frame -->
    <div class="border-8 sm:border-[15px] border-[#7c3511] drop-shadow-md my-5">
        <div class="border-4 border-[#4d2410] p-4 shadow-inner">
            <h1 class="font-semibold mb-4 text-center">Notice Board</h1>

            <!-- Notice items -->
            <div class="columns-2 lg:columns-3 gap-5">
                <!-- Notice 1 -->
                <div v-for="(notice, index) in notices" :style="getRotationStyle(index)"
                    class="rotating-div break-inside-avoid-column bg-white p-4 relative shadow-sm first:mt-0 mt-5">
                    <Link :href="route('notice.show', { slug: notice.slug })">
                    <h2 class="text-lg font-semibold text-center">{{ notice.heading }}</h2>
                    <div class="text-end text-muted"><small>{{ formatDate(notice.published_on) }}</small></div>
                    <p class="text-sm text-gray-600">{{ notice.title }}</p>
                    <img src="http://127.0.0.1:8000/assets/images/pin.png" alt=""
                        class="h-3 absolute top-1 left-1/2 drop-shadow-xl">
                    <div class="flex gap-2 justify-center mt-3">

                        <Link :href="route('admin.notices.edit', notice.id)">
                        <i
                            class="fa-solid fa-paperclip px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                        </Link>
                        <Link :href="route('admin.notices.edit', notice.id)">
                        <i
                            class="fa-solid fa-download px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                        </Link>
                        <Link :href="route('admin.notices.edit', notice.id)">
                        <i
                            class="fa-solid fa-share px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                        </Link>
                    </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>



  