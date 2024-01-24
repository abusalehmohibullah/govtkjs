<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Welcome from '@/Components/Welcome.vue';

const { classroom } = defineProps(['classroom']);
</script>

<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <div class="">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            </div>
        </template>
        <Welcome :classroom="classroom" />
    </AdminLayout>
</template>
