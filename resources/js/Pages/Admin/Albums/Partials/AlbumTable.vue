  
<script setup>
import { ref, reactive } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import Table from '@/Components/Table.vue';
import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';
import DeleteAlbumForm from '@/Pages/Admin/Albums/Partials/DeleteAlbumForm.vue';


const props = defineProps({
    albums: Object,
});

const showModal = ref(false);
const selectedAlbum = ref(null);

const toggleModal = (album) => {
    selectedAlbum.value = album;
    showModal.value = !showModal.value;
};


</script>

<template>
    <!-- <tr v-else>
                <td colspan="3" class="text-center p-3">
                    Not Data Found
                </td>
            </tr> -->





    <div class="mb-3 py-2 px-0 mx-0">

        <div class="grid grid-cols-3 grid-rows-1 gap-2 sm:grid-cols-4 sm:grid-rows-1 sm:gap-4 2xl:grid-cols-5 parent-container">
            <div v-if="albums.data.length > 0" v-for="(album, index) in albums.data" :key="index"
                class="child-container mb-2">
                <div class="d-flex align-items-center w-full">
                    <div class="show-first-child card w-full">
                        <div class="w-full rounded bg-white border shadow-sm position-relative">
                            <div class="w-full ratio ratio-4x3 overflow-hidden">
                                <a :href="route('admin.albums.media.index', album.id)" class="child stretched-link"></a>
                                <img src="https://th.bing.com/th/id/OIP.oiGEQ7J4I9AkoD_BthqYMgHaE_?pid=ImgDet&rs=1" />
                            </div>
                            <div class="relative">
                                <div class="dropdown-toggle flex justify-between items-center px-4 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="text-gray-700 text-xl font-bold m-0 text-truncate mini-text">
                                        <small>{{ album.title }}</small>
                                    </div>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item hover:bg-gray-800 hover:text-white" :href="route('admin.albums.media.index', album.id)">Open</a></li>
                                    <li><a class="dropdown-item hover:bg-gray-800 hover:text-white" :href="route('admin.albums.edit', album.id)">Edit</a></li>
                                    <li><a class="dropdown-item text-red-700 hover:bg-red-700 hover:text-white" @click="() => toggleModal(album)">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <!-- Modal form outside the table -->
    <DeleteAlbumForm :show="showModal" :album="selectedAlbum" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in albums.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === albums.links.length - 1">
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
                <template v-else-if="index === albums.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



