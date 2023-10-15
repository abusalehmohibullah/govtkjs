<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue'; // Import ref
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { media, album, albums } = defineProps(['media', 'album', 'albums']);

// const albumName = ref(null); // Define albumName ref

const form = useForm({
    _method: 'PUT',
    album_id: album.id,
    caption: media.caption,
    path: '',
});

const handleOptionSelected = (selectedLabel) => {
    form.album_id = selectedLabel; // Update albumName ref
    console.log('gg');
};

const updateMedia = () => {
    form.post(route('admin.albums.media.update', [form.album_id, media.id]), {
        errorBag: 'updateMedia',
        preserveScroll: true,
    });
};
</script>


<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateMedia">
            <template #title>
                Edit Media
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="album_id" value="Album" />
                    <SelectInput :options="albums" :selectedOption="album" inputName="album_id" :inputValue="album" @option-selected="handleOptionSelected" />

                    <InputError :message="form.errors.album_id" class="text-red-500" />
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
                <div class="col-span-12 sm:col-span-5 md:col-span-12 xl:col-span-5">
                    <InputLabel for="path" value="File">
                        <template #required>*</template>
                    </InputLabel>
                    <FileInput @input="form.path = $event.target.files[0]" id="path" v-model="form.path"
                        class="form-control mt-1 block" :class="{ 'border-red-500 focus:border-red-500': form.errors.path }"
                        type="file" />
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="absolute h-[2px]">
                        {{ form.progress.percentage }}%
                    </progress>
                    <InputError :message="form.errors.path" class="text-red-500" />
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
