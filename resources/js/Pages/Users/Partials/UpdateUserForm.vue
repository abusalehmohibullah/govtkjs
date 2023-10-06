  
<script setup>
import { useForm } from '@inertiajs/vue3';

import FormSection from '@/Components/FormSection.vue';
import RolePermission from '@/Components/Admin/RolePermission.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    user: Object,
    userRoles: Object,
    roles: Array,
});

const form = useForm({
    _method: 'PUT',
    name: props.userRoles.name,
});

const updateUser = () => {
    form.post(route('users.update', props.userRoles.id), {
        errorBag: 'updateUser',
        preserveScroll: true,
    });
};
</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateUser">
            <template #title>
                Edit User Permissions
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <!-- <InputLabel for="name" value="Class Name">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="name" v-model="form.name" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.name }" type="number" name="name" />
                    <InputError :message="form.errors.name" class="text-red-500" /> -->
                    <div class="flex items-center gap-2">
                        <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                        <div>

                            <div class="font-bold text-2xl"> {{ user.name }}</div>
                            
                            <div class="text-base"> {{ user.email }}</div>
                        </div>
                    </div>
                </div>

                <RolePermission :user="user" :roles="roles" />

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