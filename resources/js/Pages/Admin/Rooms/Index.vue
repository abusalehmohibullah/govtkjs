  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import RoomTable from '@/Pages/Admin/Rooms/Partials/RoomTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { rooms } = defineProps(['rooms']);

</script>

<template>
    <AdminLayout title="Rooms">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Rooms
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.rooms.create')">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <RoomTable :rooms="rooms" />

        </div>

    </AdminLayout>
</template>

  