  
<script setup>
import { ref, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    basicInfo: Object,
});


const form = useForm({
    history_title: props.basicInfo.history_title,
    history_content: props.basicInfo.history_content,
});


const updateAbout = () => {
    form.put(route('admin.basic-info.update'), {
        errorBag: 'updateAbout',
        preserveScroll: true,
    });
};
</script>

<template>
    <div id="aboutForm">
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateAbout">
            <template #title>
                History Section
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="history_title" value="History Title" />
                    <TextInput id="history_title" v-model="form.history_title"
                        class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.history_title }" type="text" />
                    <InputError :message="form.errors.history_title" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="history_content" value="History Content" />
                    <TextArea id="history_content" v-model="form.history_content"
                        class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.history_content }" type="text" />
                    <InputError :message="form.errors.history_content" class="text-red-500" />
                </div>

            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3" :class=" {'text-green-600' : form.recentlySuccessful, ' text-gray-600' : form.processing}">
                    {{ form.processing ? 'Saving...' : (form.recentlySuccessful ? 'Saved!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save</PrimaryButton>
            </template>

        </FormSection>
    </div>
</template>