  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import UserInvitationTable from '@/Pages/Admin/UserInvitations/Partials/UserInvitationTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { users } = defineProps(['users']);

</script>

<template>
    <AdminLayout title="Users">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                   Invited Users
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.user-invitations.create')">
                    <PrimaryButton>
                        Invite
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <UserInvitationTable :users="users" />

        </div>

    </AdminLayout>
</template>

  