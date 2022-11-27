<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

const form = useForm({
    name: '',
    email: ''
});

const submit = () => {
    form.post(route('store-member'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Add member" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add A Family Member
            </h2>
        </template>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">

            <div class="mt-4">
                <BreezeLabel for="name" value="Member Name" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Member Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <BreezeButton class="btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Add
                </BreezeButton>
            </div>
            <Link :href="route('dashboard')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Back to Dashboard
            </Link>
        </form>
        </div>
        </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
