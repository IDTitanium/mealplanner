<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';


const form = useForm({
    family_name: "",
    email: ''
});

defineProps({
    name_of_family: String,
});

const submit = () => {
    form.post(route('check-join-step-1'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};


</script>

<template>
    <Head title="Join a Family" />
    <BreezeGuestLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Join A Family
            </h2>
        </template>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">

            <div class="mt-4">
                <BreezeLabel for="name" value="Family Name" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.family_name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Your Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <BreezeButton class="btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Join
                </BreezeButton>
            </div>
            <Link :href="route('welcome')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Back to Login
            </Link>
        </form>
        </div>
        </div>
        </div>
    </BreezeGuestLayout>
</template>
