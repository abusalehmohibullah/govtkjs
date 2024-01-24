<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';

const props = defineProps({
    user: Array,
    show: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits(['close']);

const close = () => {
    emit('close');
};


const confirmingUserDeletion = ref(false);
const form = useForm({});

watch(() => {
    confirmingUserDeletion.value = props.show;
});

const deleteUser = async () => {
    try {
        // Send a DELETE request to delete the user
        form.delete(route('admin.user-invitations.destroy', props.user.id), {
            errorBag: 'deleteUser',
        });

        setTimeout(() => {
            close();
        }, 1000);

    } catch (error) {
        // Handle any errors that occur during the deletion
        console.error('Error deleting user:', error);
    }
};


</script>


<template>
    <!-- Delete User Confirmation Modal -->
    <ConfirmationModal :show="confirmingUserDeletion" :max-width="maxWidth" :closeable="closeable" @close="close">

        <template #title>
            Delete Class
        </template>

        <template #content>
            Are you sure you want to delete this Invitation?

            <div class="bg-red-100 w-full mt-2 rounded line-clamp-3 box-content">
                <span class="m-2 line-clamp-3 box-content">
                    {{ props.user.email }}
                </span>
            </div>
        </template>

        <template #footer>
            <div class="flex justify-center items-center">
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-red-600': form.processing }">
                    {{ form.processing ? 'Deleting...' : (form.recentlySuccessful ? 'Deleted!' : 'Failed') }}
                </ActionMessage>

                <SecondaryButton @click="close">
                    Cancel
                </SecondaryButton>

                <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    @click="deleteUser">
                    Delete
                </DangerButton>
            </div>
        </template>
    </ConfirmationModal>
</template>
