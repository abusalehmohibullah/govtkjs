  
<script setup>
import { ref, watch,reactive } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import Table from '@/Components/Table.vue';
import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';
import SecondaryIconButton from '@/Components/SecondaryIconButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';
import DeleteUserInvitationForm from '@/Pages/Admin/UserInvitations/Partials/DeleteUserInvitationForm.vue';

const page = usePage();

const isResending = ref(false);

watch(() => page.props.jetstream.flash, (newValue, oldValue) => {
    isResending.value = false;
});


const props = defineProps({
    users: Object,
});

const showModal = ref(false);
const selectedUser = ref(null);

const toggleModal = (user) => {
    selectedUser.value = user;
    showModal.value = !showModal.value;
};


const invitationStatus = ref({}); // Object to store status for each invitation

const startCountdown = (invitation) => {
    invitationStatus.value[invitation].showCountdown = true;
    invitationStatus.value[invitation].resendButtonDisabled = true;

    const countdownInterval = setInterval(() => {
        invitationStatus.value[invitation].countdownTimer--;

        if (invitationStatus.value[invitation].countdownTimer <= 0) {
            clearInterval(countdownInterval);
            invitationStatus.value[invitation].showCountdown = false;
            invitationStatus.value[invitation].resendButtonDisabled = false;
            invitationStatus.value[invitation].countdownTimer = 60;
        }
    }, 1000);
};

const resend = async (invitation) => {
    if (isResending.value) {
        return;
    }

    isResending.value = true;

    invitationStatus.value[invitation] = {
        showCountdown: true,
        resendButtonDisabled: true,
        countdownTimer: 60,
    };
        // Start the countdown timer
        startCountdown(invitation);


        const url = route('admin.user-invitations.resend', invitation);

        await router.put(url, {
            preserveScroll: true,
        });


}


</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">User</th>
                <th class="py-2 px-4 border-b bg-slate-200">Role</th>
                <th class="py-2 px-4 border-b bg-slate-200">Extra Ability</th>
                <th class="py-2 px-4 border-b bg-slate-200">Restriction</th>
                <th class="py-2 px-4 border-b bg-slate-200">Status</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>

            <tr v-if="users.data.length > 0" v-for="(user, index) in users.data" :key="index" class="hover:bg-blue-100"
                :class="user.status === 0 ? 'bg-slate-100' : ''">
                <td class="py-2 px-4 border-b text-center">{{ (users.current_page - 1) * users.per_page + index + 1 }}</td>
                <td class="py-2 px-4 border-b">
                    <div>{{ user.email }}</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="user.roles.length > 0" class="flex flex-wrap gap-1 justify-center">
                        <div v-for="role in user.roles" :key="role.id"
                            class="bg-gray-800 text-white rounded-full px-2 py-1 capitalize">{{ role.name }}</div>
                        <!-- <div v-for="role in user.roles" :key="role.id" class="flex flex-wrap gap-1">
                            <span v-for="permission in role.permissions" :key="permission.id">
                                {{ permission.name }}
                            </span>
                        </div> -->
                    </div>
                    <div v-else>No roles assigned</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="user.extras.length > 0" class="flex flex-wrap gap-1 justify-center">
                        <div v-for="extra in user.extras" :key="extra"
                            class="bg-green-700 text-white rounded-full px-2 py-1 capitalize text-xs">{{ extra.replace(/_/g,
                                ' ')
                            }}</div>
                    </div>
                    <div v-else>No extra permissions</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="user.restrictions.length > 0" class="flex flex-wrap gap-1 justify-center">
                        <div v-for="restriction in user.restrictions" :key="restriction"
                            class="bg-red-700 text-white rounded-full px-2 py-1 capitalize text-xs">{{
                                restriction.replace(/_/g, ' ') }}</div>
                    </div>
                    <div v-else>No restrictions</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div class="capitalize font-semibold"
                        :class="{ 'text-green-700': user.status == 'accepted' }, { 'text-gray-400': user.status == 'pending' }, { 'text-red-700': user.status == 'expired' }">
                        {{ user.status }}</div>
                </td>

                <td class="py-2 px-4 border-b text-center">
                    <div v-if="user.status != 'accepted'">
                        <div v-if="invitationStatus[user.id]?.showCountdown">
                            Resend in {{ invitationStatus[user.id]?.countdownTimer }}s
                        </div>
                        <div v-else class="flex justify-center">
                            <button @click="resend(user.id)"
                                :disabled="isResending || invitationStatus[user.id]?.resendButtonDisabled">
                                <SecondaryIconButton
                                :class="{'cursor-not-allowed' : isResending}">
                                    <i class="fas fa-paper-plane"></i>
                                </SecondaryIconButton>
                            </button>

                            <Link class="ml-1" :href="route('admin.user-invitations.edit', user.id)">
                            <PrimaryIconButton>
                                <i class="fas fa-pen"></i>
                            </PrimaryIconButton>
                            </Link>

                            <!-- Delete button -->
                            <DangerIconButton class="ml-1" @click="() => toggleModal(user)">
                                <i class="fas fa-trash"></i>
                            </DangerIconButton>

                        </div>

                    </div>

                    <div v-else>-</div>
                </td>
            </tr>

            <tr v-else>
                <td colspan="3" class="text-center p-3">
                    Not Data Found
                </td>
            </tr>
        </template>
    </Table>
    <!-- Modal form outside the table -->
    <DeleteUserInvitationForm :show="showModal" :user="selectedUser" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in users.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === users.links.length - 1">
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
                <template v-else-if="index === users.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



