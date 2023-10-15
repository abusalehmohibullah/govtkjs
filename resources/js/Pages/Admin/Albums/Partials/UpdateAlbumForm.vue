  
<script setup>
import { useForm } from '@inertiajs/vue3';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    album: Object,
});

const form = useForm({
    _method: 'PUT',
    title: props.album.title,
    description: props.album.description,
    scroll: props.album.scroll, // Ensure scroll is a string
});

const updateAlbum = () => {
    form.post(route('admin.albums.update', props.album.id), {
        errorBag: 'updateAlbum',
        preserveScroll: true,
    });
};
</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateAlbum">
            <template #title>
                Edit Album
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="title" value="Title">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="title" v-model="form.title" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.title }" type="text" name="title" />
                    <InputError :message="form.errors.title" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="description" value="Description" />
                    <TextArea id="description" v-model="form.description" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.description }" name="description" />
                    <InputError :message="form.errors.description" class="text-red-500" />
                </div>

            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Saving...' : (form.recentlySuccessful ? 'Saved!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>