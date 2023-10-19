  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import MediaTable from '@/Pages/Admin/Media/Partials/MediaTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue';

const { mediaFiles, album } = defineProps(['mediaFiles', 'album']);

</script>

<template>
    <AdminLayout title="Basic Info">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    {{ album.title }}
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.albums.media.create', album)">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <MediaTable :album="album" :mediaFiles="mediaFiles" />

        </div>

    </AdminLayout>
</template>

  