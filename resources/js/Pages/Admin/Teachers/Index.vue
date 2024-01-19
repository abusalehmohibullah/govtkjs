  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import TeacherTable from '@/Pages/Admin/Teachers/Partials/TeacherTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { teachers } = defineProps(['teachers']);

</script>

<template>
    <AdminLayout title="Teachers">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Teachers
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.teachers.create')">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <TeacherTable :teachers="teachers" />

        </div>

    </AdminLayout>
</template>

  