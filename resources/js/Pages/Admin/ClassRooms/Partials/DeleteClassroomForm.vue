<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';

const props = defineProps({
    classroom: Array,
    show: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits(['close']);

const close = () => {
    emit('close');
};


const confirmingClassroomDeletion = ref(false);
const form = useForm({});

watch(() => {
    confirmingClassroomDeletion.value = props.show;
});

const deleteClassroom = async () => {
    try {
        // Send a DELETE request to delete the classroom
        form.delete(route('admin.classrooms.destroy', props.classroom.id), {
            errorBag: 'deleteClassroom',
        });

        setTimeout(() => {
            close();
        }, 1000);

    } catch (error) {
        // Handle any errors that occur during the deletion
        console.error('Error deleting classroom:', error);
    }
};


</script>


<template>
    <!-- Delete Classroom Confirmation Modal -->
    <ConfirmationModal :show="confirmingClassroomDeletion" :max-width="maxWidth" :closeable="closeable" @close="close">

        <template #title>
            Delete Class
        </template>

        <template #content>
            Are you sure you want to delete this class?

            <div class="bg-red-100 w-full mt-2 rounded line-clamp-3 box-content">
                <span class="m-2 line-clamp-3 box-content">
                    {{ props.classroom.name }}
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
                    @click="deleteClassroom">
                    Delete
                </DangerButton>
            </div>
        </template>
    </ConfirmationModal>
</template>
