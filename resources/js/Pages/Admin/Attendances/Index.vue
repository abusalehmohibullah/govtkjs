  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import AttendanceTable from '@/Pages/Admin/Attendances/Partials/AttendanceTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue';

const { working_days, selected_classroom, classrooms, students, selected_month } = defineProps(['working_days', 'selected_classroom', 'classrooms', 'students', 'selected_month']);

</script>

<template>
    <AdminLayout title="Basic Info">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Attendances
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.attendances.create', { selected_classroom: selected_classroom.id})">
                    <PrimaryButton>
                        Take Attendance
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <AttendanceTable :working_days="working_days" :selected_classroom="selected_classroom" :classrooms="classrooms" :students="students" :selected_month="selected_month" />
            
        </div>

    </AdminLayout>
</template>

  