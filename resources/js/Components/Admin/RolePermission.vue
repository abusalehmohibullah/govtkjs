  
<script setup>
import { ref, onMounted, defineProps, computed } from 'vue';

// Define props explicitly
const props = defineProps({
    user: Object,
    roles: Array,
});

const selectedPermissions = ref([]);

// Example of handling form submission
const submitForm = () => {
    // Handle the selected permissions and submit the form
    console.log(selectedPermissions.value);
};

const isSelectAllChecked = (roleId) => {
    const rolePermissions = props.roles.find(role => role.id === roleId).permissions.map(permission => permission.id);
    return rolePermissions.every(permissionId => selectedPermissions.value.includes(permissionId));
};

const toggleAllPermissions = (role) => {
    const rolePermissions = role.permissions.map(permission => permission.id);
    if (isSelectAllChecked(role.id)) {
        // Deselect all permissions in this group
        selectedPermissions.value = selectedPermissions.value.filter(permissionId => !rolePermissions.includes(permissionId));
    } else {
        // Select all permissions in this group
        selectedPermissions.value = [...selectedPermissions.value, ...rolePermissions];
    }
};

onMounted(() => {
    // Perform any additional setup or data fetching if needed when the component is mounted
});
</script>
  
<template>
    <div>
        <div v-for="role in roles" :key="role.id" class="py-1">
            <label class="text-lg capitalize">
                <input type="checkbox" :checked="isSelectAllChecked(role.id)" @change="toggleAllPermissions(role)"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                {{ role.name.replace(/_/g, ' ') }}
            </label>
            <div class="ml-5">
                <div v-for="permission in role.permissions" :key="permission.id" class="py-1">
                    <label class="text-lg capitalize">
                        <input type="checkbox" :value="permission.id" v-model="selectedPermissions"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        {{ permission.name.replace(/_/g, ' ') }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>
