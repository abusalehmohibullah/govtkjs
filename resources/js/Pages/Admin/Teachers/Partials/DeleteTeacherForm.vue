<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';

const props = defineProps({
    teacher: Array,
    show: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits(['close']);

const close = () => {
    emit('close');
};


const confirmingTeacherDeletion = ref(false);
const form = useForm({});

watch(() => {
    confirmingTeacherDeletion.value = props.show;
});

const deleteTeacher = async () => {
    try {
        // Send a DELETE request to delete the teacher
        form.delete(route('admin.teachers.destroy', props.teacher.id), {
            errorBag: 'deleteTeacher',
        });

        setTimeout(() => {
            close();
        }, 1000);

    } catch (error) {
        // Handle any errors that occur during the deletion
        console.error('Error deleting teacher:', error);
    }
};


</script>


<template>
    <!-- Delete Teacher Confirmation Modal -->
    <ConfirmationModal :show="confirmingTeacherDeletion" :max-width="maxWidth" :closeable="closeable" @close="close">

        <template #title>
            Delete Class
        </template>

        <template #content>
            Are you sure you want to delete this class?

            <div class="bg-red-100 w-full mt-2 rounded line-clamp-3 box-content">
                <div v-if="teacher.user.profile_photo_url != ''"><img :src="teacher.user.profile_photo_url" class="d-block ml-2 mt-2 h-24 w-20" alt="...">
                </div>
                <div v-else class="h-24 w-20 flex justify-center items-center flex-col">
                    <div>No</div>
                    <div>Photo</div>
                    <div>Found</div>
                </div>
                <span class="m-2 line-clamp-3 box-content">
                    {{ props.teacher.user.name }}
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
                    @click="deleteTeacher">
                    Delete
                </DangerButton>
            </div>
        </template>
    </ConfirmationModal>
</template>
