  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { album } = defineProps(['album']);

const form = useForm({
    album: album.title,
    caption: '',
    paths: [],
});

const createMedia = () => {
    form.post(route('admin.albums.media.store', album.id), {
        errorBag: 'createMedia',
        preserveScroll: true,
    });
};

const photoPreview = ref([]);

const previewPhoto = (event) => {
    const newFiles = Array.from(event.target.files);

    newFiles.forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = (e) => {
                // Append new previews or create a new array if necessary
                if (!photoPreview.value[index]) {
                    photoPreview.value[index] = {
                        src: e.target.result,
                        file: file, // Save the file object for reference
                    };
                } else {
                    // Append new preview for the same index
                    photoPreview.value.push({
                        src: e.target.result,
                        file: file,
                    });
                }
            };

            reader.readAsDataURL(file);
        } else {
            // Clear the preview for non-image files
            photoPreview.value[index] = null;
        }
    });

    // Concatenate the new files with the existing ones in form.paths
    form.paths = [...form.paths, ...newFiles];

    console.log(photoPreview);
};

const removePreview = (index) => {
    // Remove the preview at the specified index
    photoPreview.value.splice(index, 1);

    // Remove the corresponding file from the form.paths array
    form.paths.splice(index, 1);

    // Reassign the updated form.paths to trigger the reactivity
    form.paths = [...form.paths];
};

const clearAllPreview = () => {
    form.paths = [];
    photoPreview.value = [];
}

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="createMedia">
            <template #title>
                Add Media
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="album" value="Album" />
                    <TextInput id="album" v-model="form.album" required class="mt-1 block w-full bg-slate-100"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.album }" type="text" name="album"
                        disabled />
                    <InputError :message="form.errors.album" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="caption" value="Caption">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="caption" v-model="form.caption" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.caption }" type="text"
                        name="caption" />
                    <InputError :message="form.errors.caption" class="text-red-500" />
                </div>
                <!-- Updated file input to accept multiple images -->
                <div class="col-span-12 sm:col-span-5 md:col-span-12 xl:col-span-5">
                    <InputLabel for="paths" value="Files">
                        <template #required>*</template>
                    </InputLabel>
                    <FileInput @change="previewPhoto" id="paths" class="form-control mt-1 block"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.paths }" type="file" accept="image/*" multiple />
                    <InputError :message="form.errors.paths" class="text-red-500" />
                </div>
                <div v-if="photoPreview.length > 0" class="flex">
                    <div class="text-lg font-medium">Total Selected: <span class="text-green-600 font-bold">{{ photoPreview.length }}</span> </div>
                    <button class="bg-red-600 rounded px-2 text-white ml-5" @click="clearAllPreview">Remove All</button>
                </div>
                <!-- Preview system -->
                <div v-if="form.paths.length" class="w-full flex items-center flex-wrap">
                    <div v-for="(preview, index) in photoPreview" :key="index"
                        class="relative w-1/3 aspect-video border shadow">
                        <img v-if="preview" :src="preview.src" alt="Photo Preview"
                            class="object-cover w-full aspect-video" />
                        <img v-else :src="'/assets/images/preview.png'" alt="Photo Preview"
                            class="object-contain w-full aspect-video" />
                        <button @click="removePreview(index)"
                            class="absolute top-0 right-0 px-2 py-1 bg-red-500 text-white"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                </div>
            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Creating...' : (form.recentlySuccessful ? 'Created!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>