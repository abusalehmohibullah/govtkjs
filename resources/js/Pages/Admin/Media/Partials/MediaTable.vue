  
<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import DeleteMediaForm from '@/Pages/Admin/Media/Partials/DeleteMediaForm.vue';

const { mediaFiles, album } = defineProps(['mediaFiles', 'album']);

// const props = defineProps({
//     mediaFiles: Object,
// });

const showModal = ref(false);
const selectedMedia = ref(null);

const toggleModal = (media) => {
    selectedMedia.value = media;
    showModal.value = !showModal.value;
};


</script>

<template>

    <div class="mb-3 py-2 px-0 mx-0">

        <div class="grid grid-cols-3 grid-rows-1 gap-2 sm:grid-cols-4 sm:grid-rows-1 sm:gap-4 2xl:grid-cols-5 parent-container">
            <div v-if="mediaFiles.data.length > 0" v-for="(media, index) in mediaFiles.data" :key="index"
                class="child-container mb-2">
                <div class="d-flex align-items-center w-full">
                    <div class="show-first-child card w-full">
                        <div class="w-full rounded bg-slate-200 border shadow-sm position-relative">
                            <div class="w-full ratio ratio-4x3 overflow-hidden">
                                <img :src="'/storage/' + media.path" class="object-cover"/>
                            </div>
                            <div class="relative">
                                <div class="dropdown-toggle flex justify-between items-center px-4 py-2 cursor-pointer" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="text-gray-700 text-xl font-bold m-0 text-truncate mini-text">
                                        <small>{{ media.caption }}</small>
                                    </div>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item hover:bg-gray-800 hover:text-white" :href="route('admin.albums.media.edit', [album.id, media.id])">Edit</a></li>
                                    <li><a class="dropdown-item text-red-600 hover:bg-red-600 hover:text-white" @click="() => toggleModal(media)">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <!-- Modal form outside the table -->
    <DeleteMediaForm :show="showModal" :media="selectedMedia" :album="album" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in mediaFiles.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === mediaFiles.links.length - 1">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" />
                    </template>
                    <template v-else>
                        <SecondaryPaginatorButton v-html="link.label" />
                    </template>
                </template>
                </Link>
            </template>
            <template v-else>
                <template v-if="index === 0">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" class='opacity-40' />
                </template>
                <template v-else-if="index === mediaFiles.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



