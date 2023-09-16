  
<script setup>

import { useForm } from '@inertiajs/vue3';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import FileInput from '@/Components/FileInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    caption: '',
    description: '',
    path: null,
});

const createSlider = () => {
    form.post(route('admin.sliders.store'), {
        errorBag: 'createSlider',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="createSlider">
            <template #title>
                Add Slider
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="caption" value="Caption">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="caption" v-model="form.caption" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.caption }" type="text" name="caption" />
                    <InputError :message="form.errors.caption" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="description" value="Description" />
                    <TextArea id="description" v-model="form.description" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.description }" name="description" />
                    <InputError :message="form.errors.description" class="text-red-500" />
                </div>
                <div class="grid grid-cols-12 col-span-6 sm:col-span-4 gap-3 xl:gap-0">
                    <div class="col-span-12">
                        <InputLabel for="path" value="Image">
                            <template #required>*</template>
                        </InputLabel>
                        <FileInput @input="form.path = $event.target.files[0]" id="path"
                        v-model="form.path" class="form-control mt-1 block"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.path }" type="file" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="absolute h-[2px]">
                            {{ form.progress.percentage }}%
                        </progress>
                        <InputError :message="form.errors.path" class="text-red-500" />
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