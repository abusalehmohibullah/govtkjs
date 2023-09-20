<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import { ref, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const page = usePage();
const show = ref(true);
const style = ref('success');
const message = ref('');

watchEffect(async () => {
    style.value = page.props.jetstream.flash?.bannerStyle || 'success';
    message.value = page.props.jetstream.flash?.banner || '';
    show.value = true;
});

defineProps({
    notices: Object,
});
</script>


<template>
        <div class="notice-box shadow-sm bg-[#FBEEAC] px-3 py-2 h-full">
        <!-- <div class="notice-box shadow-sm bg-[#DFF6FF] px-3 py-2 h-full"> -->
    <!-- <div class="notice-box shadow-sm bg-[#ebf4f3] px-3 py-2 h-full rounded"> -->
        <div class="d-flex jusify-content-center align-items-center">
            <h3 class="alert-heading deep-color mt-2 large-text">Notice</h3>
            <div class="ms-auto"><a href="https://mdch.edu.bd/education/news">See All</a></div>
        </div>
        <hr>
        <div class="notices">
            <ul>
                <li v-for="notice in notices" class="animate-on-scroll animate__animated animate__fadeInDown"
                    data-animation="fadeInDown" style="animation-delay: 0s;">
                    <a href="#" class="text-nowrap">
                        <div class="flex gap-2">
    
                                <img src="assets/images/pin.png" alt="" class="h-5">
             
                            <div class="text-truncate text-base text-gray-600 hover:text-gray-800 hover:underline">
                                {{ notice.title }}
                            </div>
                        </div>
                        <div class="text-end mb-2 text-muted"><small>{{ notice.published_on }}</small></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>


