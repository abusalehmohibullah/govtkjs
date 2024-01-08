  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import StudentTable from '@/Pages/Admin/Students/Partials/StudentTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue';

const { students, selected_classroom } = defineProps(['students', 'selected_classroom']);

</script>

<template>
    <AdminLayout title="Basic Info">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Students
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.students.create', { selected_classroom: selected_classroom})">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <StudentTable :students="students" />
            
        </div>

    </AdminLayout>
</template>

  