<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';

const props = defineProps({
    room: Array,
    show: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits(['close']);

const close = () => {
    emit('close');
};


const confirmingRoomDeletion = ref(false);
const form = useForm({});

watch(() => {
    confirmingRoomDeletion.value = props.show;
});

const deleteRoom = async () => {
    try {
        // Send a DELETE request to delete the room
        form.delete(route('admin.rooms.destroy', props.room.id), {
            errorBag: 'deleteRoom',
        });

        setTimeout(() => {
            close();
        }, 1000);

    } catch (error) {
        // Handle any errors that occur during the deletion
        console.error('Error deleting room:', error);
    }
};


</script>


<template>
    <!-- Delete Room Confirmation Modal -->
    <ConfirmationModal :show="confirmingRoomDeletion" :max-width="maxWidth" :closeable="closeable" @close="close">

        <template #title>
            Delete Class
        </template>

        <template #content>
            Are you sure you want to delete this class?

            <div class="bg-red-100 w-full mt-2 rounded line-clamp-3 box-content">
                <span class="m-2 line-clamp-3 box-content">
                    {{ props.room.name }}
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
                    @click="deleteRoom">
                    Delete
                </DangerButton>
            </div>
        </template>
    </ConfirmationModal>
</template>
